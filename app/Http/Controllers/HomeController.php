<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Mail\PasswordMail;
use App\Mail\TicketConfirmed;
use App\Models\Branch;
use App\Models\Bundle;
use App\Models\Coupon;
use App\Models\Facility;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\TicketPayment;
use App\Models\UserBundlePayment;
use App\Models\TicketSlot;
use App\Models\User;
use App\Models\UserBundle;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Mpdf\Mpdf;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home()
    {
        $params = [];

        return view('dashboard.home', $params);
    }

    public function language()
    {
        if (session()->has('language') && session('language') == 'bn') {
            session(['language' => 'en']);
        } else {
            session(['language' => 'bn']);
        }
        return back();
    }

    public function ticket(Request $request)
    {
        $branch = Branch::where('name', $request->branch)->first();

        if ($branch) {
            $bundle = Bundle::where('branch_id', $branch->id)->where('title', $request->bundle)->first();
            $bundle ? $bundle->facility : null;
            $bundles = $branch->bundles->map(function ($item) {
                $item->facility;
                return [
                    'item_id' => $item->id,
                    'item'    => $item,
                ];
            })->toArray();
            $params = [
                'slots'         => $branch->slots ?? [],
                'branch'        => $branch,
                'bundle'        => $bundle ?? false,
                'bundles'       => $branch->bundles,
                'bundles_box'   => array_column($bundles, 'item', 'item_id'),
                'facilities'    => $branch->facilities ?? [],
            ];

            return view('customer.ticket.create', $params);
        }

        $params = [
            'branches'  => Branch::all()
        ];
        return view('customer.ticket.branch', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function ticket_store(Request $request)
    {
        $branch = Branch::where('name', $request->branch)->first();
        if (!$branch) {
            return back()->withInput()->with('fail', __('Branch not found!'));
        }

        $request->validate([
            'date'      => ['required', 'string', 'max:191'],
            'slot'      => ['required', 'string', 'max:191'],
        ]);

        if (!Auth::check()) {
            $request->validate([
                'name'      => ['required', 'string', 'max:191'],
                'email'     => ['required', 'string', 'max:191'],
                'mobile'    => ['nullable', 'string', 'max:191'],
                'address'   => ['nullable', 'string', 'max:191'],
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                $user           = new User;
                $password       = Str::random(8);
                $user->name     = $request->name;
                $user->email    = $request->email;
                $user->password = bcrypt($password);
                $user->mobile   = $request->mobile;
                $user->address  = $request->address;
                $user->status   = 'active';
                $user->save();
                $params = [
                    'name'      => $user->name,
                    'mobile'    => $user->mobile,
                    'email'     => $user->email,
                    'password'  => $password,
                    'message'   => 'Please use these information to next login.',
                ];

                $admin_emails = Helpers::getAdminEmailList($branch->id);

                Mail::to($user->email)->bcc($admin_emails)->send(new PasswordMail($params));
            }
        } else {
            $user = Auth::user();
        }

        $facility = Facility::find($request->facility);

        DB::beginTransaction();

        $subtotal = ($request->adult_number * $branch->regular_price) + ($request->child_number * $branch->child_price) + ($facility ? $facility->cost : 0);

        $coupon = Coupon::where('code', $request->coupon)->first();
        $discount = optional($coupon)->discount ?? 0;
        $discount_amount = $subtotal * ($discount / 100);
        $bundle = Bundle::find($request->bundle);

        $total = $subtotal - $discount_amount;
        $reference = '';
        while (true) {
            $reference = rand(100000, 999999);
            $ticket = Ticket::where('reference', $reference)->first();
            if (!$ticket) {
                break;
            }
        }

        $ticket                         = new Ticket;
        $ticket->reference              = $reference;
        $ticket->date                   = $request->date;
        $ticket->regular_ticket_count   = $request->adult_number;
        $ticket->child_ticket_count     = $request->child_number;
        $ticket->regular_ticket_price   = $branch->regular_price;
        $ticket->child_ticket_price     = $branch->child_price;
        $ticket->sub_total              = $subtotal;
        $ticket->discount               = $discount;
        $ticket->total                  = $bundle ? $bundle->offer_price : $total;
        $ticket->grand_total            = $bundle ? $bundle->offer_price : $total;
        $ticket->facility_id            = $bundle ? $bundle->facility_id : $request->facility;
        $ticket->bundle_id              = $request->bundle ?? null;
        $ticket->slot_id                = $request->slot;
        $ticket->branch_id              = $branch->id;
        $ticket->coupon_id              = $coupon ? $coupon->id : null;
        $ticket->customer_id            = $user->id;

        if (!$ticket->save()) {
            return back()->withInput()->with('fail', __('Ticket creation request failed!'));
        }

        // $ticket->customer->notify(new Notification());

        $slot = $request->slot;
        $slot_reservation_loop = ceil(($request->adult_number + $request->child_number - 2) / 5);

        for ($i = 1; $i <= $slot_reservation_loop; $i++) {
            $ticket_slot = TicketSlot::where('branch_id', $branch->id)->where('slot_id', $slot)->whereDate('date', $request->date)->first();
            if ($ticket_slot->status == 'free') {
                $ticket_slot->status    = 'booked';
                $ticket_slot->ticket_id = $ticket->id;
                $ticket_slot->save();
            } else {
                DB::rollBack();
                return back()->withInput()->with('fail', __('Slot is booked. Choose another slot.'));
            }
            $slot++;
        }
        DB::commit();

        return redirect()->route('ticket.detail', $ticket->reference)->with('success', __('Ticket booked successfully'));
    }

    public function ticket_detail(Request $request)
    {
        $ticket = Ticket::where('reference', $request->reference)->first();

        if (!$ticket) {
            $ticket = Ticket::withTrashed()->where('reference', $request->reference)->first();
            if($ticket) {
                return redirect()->route('ticket.create')->with('fail', __('Ticket expired! please buy new ticket'));
            }
            abort(404);
        }

        $payment_ids = TicketPayment::where('ticket_id', $ticket->id)->pluck('payment_id')->toArray();
        $payment = Payment::whereIn('id', $payment_ids)->where('status', 'Pending')->first();

        if (!$payment && $ticket->payment_status != 'paid') {
            $post_data = PaymentController::getPaymentPostData();

            $post_data['total_amount']  = $ticket->grand_total; # You cant not pay less than 10
            $post_data['ticket_id']     = $ticket->id;
            $post_data['branch_id']     = $ticket->branch_id;
            $post_data['cus_name']      = optional($ticket->customer)->name;
            $post_data['cus_email']     = optional($ticket->customer)->email;
            $post_data['cus_phone']     = optional($ticket->customer)->mobile;
            $post_data['product_name']  = 'Ticket';
            $post_data['product_category'] = optional($ticket->branch)->name;

            Payment::updateOrCreate(['tran_id' => $post_data['tran_id']], [
                'amount'            => $post_data['total_amount'],
                'currency'          => $post_data['currency'],
                'status'            => 'Pending',
                'branch_id'         => $ticket->branch_id,
                'customer_id'       => $ticket->customer_id,
                'post_data'         => json_encode($post_data),
            ]);

            $payment = Payment::where('tran_id', $post_data['tran_id'])->first();
            TicketPayment::updateOrCreate(['payment_id' => $payment->id], [
                'ticket_id' => $ticket->id
            ]);
        }

        $params = [
            'payment' => $payment,
            'ticket' => $ticket,
            'branch' => $ticket->branch,
        ];

        return view('customer.ticket.detail', $params);
    }

    public function ticket_mail(Request $request)
    {
        
        $ticket = Ticket::where('reference', $request->reference)->first();
    //    dd($ticket);
        if (!$ticket) {
            abort(404);
        }

        $params = [
            'reference' => $request->reference,
            'message'   => 'Dear ' . optional($ticket->customer)->name . ', go through the link and preserve it.',
        ];

        $admin_emails = Helpers::getAdminEmailList($ticket->branch_id);

        Mail::to($ticket->customer->email)->bcc($admin_emails)->send(new TicketConfirmed($params));

        return back()->with('success', 'Mail sent successfully.');
    }

    public function bundle(Request $request)
    {
        $branch = Branch::where('name', $request->branch)->first();

        if (!$branch) {
            abort(404);
        }

        $bundle = Bundle::where('title', $request->bundle)->where('branch_id', $branch->id)->first();

        if (!$bundle) {
            abort(404);
        }

        $params = [
            'branch' => $branch,
            'bundle' => $bundle,
        ];
        return view('customer.bundle.create', $params);

        // $params = [
        //     'branches'  => Branch::all()
        // ];
        // return view('bundle-branch', $params);
    }

    public function bundle_store(Request $request)
    {
        $request->validate([
            'bundle'    => ['required', 'string', 'max:191'],
            'branch'    => ['required', 'string', 'max:191'],
        ]);

        $bundle = Bundle::find($request->bundle);
        if(!$bundle) {
            return back()->withInput()->with('fail', __('Bundle missing!'));
        }

        if (!Auth::check()) {
            $request->validate([
                'name'      => ['required', 'string', 'max:191'],
                'email'     => ['required', 'string', 'max:191'],
                'mobile'    => ['required', 'string', 'max:191'],
                'address'   => ['nullable', 'string', 'max:191'],
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                $user           = new User;
                $password       = Str::random(8);
                $user->name     = $request->name;
                $user->email    = $request->email;
                $user->password = bcrypt($password);
                $user->mobile   = $request->mobile;
                $user->address  = $request->address;
                $user->status   = 'active';
                $user->save();
                $params = [
                    'name'      => $user->name,
                    'mobile'    => $user->mobile,
                    'email'     => $user->email,
                    'password'  => $password,
                    'message'   => 'Please use these information to next login.',
                ];

                $admin_emails = Helpers::getAdminEmailList($bundle->branch->id);

                Mail::to($user->email)->bcc($admin_emails)->send(new PasswordMail($params));
            }
        } else {
            $user = Auth::user();
        }

        $reference = '';
        while (true) {
            $reference = Str::random(8);
            $ticket = UserBundle::where('reference', $reference)->first();
            if (!$ticket) {
                break;
            }
        }
        $user_bundle =  new UserBundle;
        $user_bundle->reference             = $reference;
        $user_bundle->bundle_id             = $bundle->id;
        $user_bundle->customer_id           = $user->id;
        $user_bundle->child_ticket_count    = $bundle->child_ticket_count;
        $user_bundle->regular_ticket_count  = $bundle->regular_ticket_count;
        $user_bundle->normal_price          = $bundle->normal_price;
        $user_bundle->offer_price           = $bundle->offer_price;
        if (!$user_bundle->save()) {
            return back()->withInput()->with('fail', __('Customer Bundle creation request failed!'));
        }
        return redirect()->route('bundle.detail', $user_bundle->reference)->with('success', __('Bundle booked successfully'));
    }

    public function bundle_detail(Request $request)
    {
        $user_bundle = UserBundle::where('reference', $request->reference)->first();

        if (!$user_bundle) {
            abort(404);
        }

        $payment_ids = UserBundlePayment::where('user_bundle_id', $user_bundle->id)->pluck('payment_id')->toArray();
        $payment = Payment::whereIn('id', $payment_ids)->where('status', 'Pending')->first();

        if (!$payment && $user_bundle->payment_status != 'paid') {
            $post_data = PaymentController::getPaymentPostData();

            $post_data['total_amount']  = $user_bundle->bundle->offer_price; # You cant not pay less than 10
            $post_data['bundle_id']     = $user_bundle->bundle_id;
            $post_data['branch_id']     = optional($user_bundle->bundle)->branch_id;
            $post_data['cus_name']      = optional($user_bundle->customer)->name;
            $post_data['cus_email']     = optional($user_bundle->customer)->email;
            $post_data['cus_phone']     = optional($user_bundle->customer)->mobile;
            $post_data['product_name']  = 'Bundle';
            $post_data['product_category'] = optional($user_bundle->bundle->branch)->name;

            Payment::updateOrCreate(['tran_id' => $post_data['tran_id']], [
                'amount'        => $post_data['total_amount'],
                'currency'      => $post_data['currency'],
                'status'        => 'Pending',
                'type'          => 'Bundle',
                'branch_id'     => $user_bundle->bundle->branch_id,
                'customer_id'   => $user_bundle->customer_id,
                'post_data'     => json_encode($post_data),
            ]);

            $payment = Payment::where('tran_id', $post_data['tran_id'])->first();
            UserBundlePayment::updateOrCreate(['payment_id' => $payment->id], [
                'user_bundle_id' => $user_bundle->id
            ]);
        }

        $params = [
            'bundle'        => $user_bundle->bundle,
            'branch'        => $user_bundle->bundle->branch,
            'payment'       => $payment,
            'user_bundle'   => $user_bundle,
        ];

        return view('customer.bundle.detail', $params);
    }

    public function ticket_print(Request $request)
    {
        $ticket = Ticket::where('reference', $request->reference)->first();
        try {
            $params = [
                'ticket'    => $ticket,
                'branch'    => $ticket->branch
            ];
            // dd($params);
            $pdf_html = view('dashboard.ticket.print', $params)->render();
            // return $pdf_html;

            $pdf_filename = Str::slug('ticket-' . $ticket->reference . '-') . '.pdf';

            $pdf = new Mpdf([
                'mode'          => 'utf-8',
                'format'        => 'A4-L',
                'tempDir'       => Storage::path('temp'),
                // 'defaultCssFile' => public_path() . '/css/app.css',
                'debug'         => true,
                'margin_left' => 18,
                'margin_right' => 17,
                'margin_top' => 17,
                'margin_bottom' => 10,
                'margin_header' => 10,
                'margin_footer' => 10,
            ]);

            $pdf->showImageErrors = true;
            // $pdf->WriteHTML('<h1>Hello world!</h1>');
            $pdf->WriteHTML($pdf_html);

            return $pdf->Output($pdf_filename, 'I');
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function branch_detail(Request $request)
    {
        if (!empty($request->branch_id)) {
            $branch = Branch::find($request->branch_id);
        }

        $params = [
            'branch'    => $branch,
        ];
        return $params;
    }

    public function slot_check(Request $request)
    {
        $branch = Branch::find($request->branch_id);
        $date = $request->date;
        foreach ($branch->slots as $slot) {
            $ticket_slot = TicketSlot::where('branch_id', $branch->id)->where('slot_id', $slot->id)->whereDate('date', $date)->first();
            if (!$ticket_slot) {
                $ticket_slot = new TicketSlot;
                $ticket_slot->date      = $date;
                $ticket_slot->slot_id   = $slot->id;
                $ticket_slot->branch_id = $branch->id;
                $ticket_slot->save();
            } else {
                break;
            }
        }
        // sleep(1);
        
        return $ticket_slot =  TicketSlot::with('slot')->where('branch_id', $request->branch_id)->whereDate('date', $date)->whereHas('slot', function($query) {
            $query->whereNull('deleted_at');
        })->get();
    }

    public function coupon_check(Request $request)
    {
        $coupon = false;
        if ($request->date && $request->coupon) {
            $day = date('w', strtotime($request->date));
            $coupon = Coupon::where('branch_id', $request->branch)->where('code', $request->coupon)->first();
            if ($coupon && $coupon->start_date && $coupon->end_date && !($coupon->start_date <= $request->date && $coupon->end_date >= $request->date)) {
                $coupon = false;
            }
            $coupon = $coupon && array_key_exists($day, json_decode($coupon->days, true) ?? []) ? $coupon : false;
        }
        $params = [
            'status'    => $coupon ? true : false,
            'coupon'    => $coupon,
        ];
        return $params;
    }
}
