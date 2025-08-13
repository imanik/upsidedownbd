<?php

namespace App\Http\Controllers;

use App\Helpers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Mail\TicketConfirmed;
use App\Mail\TicketBookingCanceled;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test(Request $request)
    {
        // $expired_ticket_time = Carbon::now()->subHour();
        // $tickets = Ticket::where('status', 'not-visited')->where('payment_status', 'unpaid')->get()->filter(function($ticket) use ($expired_ticket_time){
        //     return $expired_ticket_time->gt(Carbon::parse($ticket->created_at));
        // });

        // foreach ($tickets as $ticket) {

        //     foreach ($ticket->slots as $slot) {
        //         $slot->status = 'free';
        //         $slot->ticket_id = null;
        //         $slot->save();
        //     }
        //     $ticket->delete();

        //     $customer_email = optional($ticket->customer)->email;

        //     $params = [
        //         'message'   => 'Dear ' . optional($ticket->customer)->name . ', your booked ticket canceled ref#' . $ticket->reference,
        //     ];

        //     $admin_emails = Helpers::getAdminEmailList($ticket->branch_id);

        //     Mail::to($customer_email)->bcc($admin_emails)->send(new TicketBookingCanceled($params));
        // }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(Request $request)
    {
        if (!(Auth::user()->is_admin || Auth::user()->role)) {
            return redirect()->route('customer.dashboard');
        }

        $users      = User::count() ?? 0;
        $new_users  = User::whereDate('created_at', Carbon::today())->count() ?? 0;
        $tickets    = Ticket::latest();
        $tickets    = $tickets->whereDate('created_at', Carbon::today());
        if (!Auth::user()->is_admin) {
            $tickets    = $tickets->where('branch_id', Auth::user()->branch_id);
        }
        $tickets = $tickets->count();

        $month = $request->month ?? date('Y-m');
        $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        $month_first_day = Carbon::parse(date('Y-m-d', strtotime($month)))->startOfMonth()->format('w');
        $date = Carbon::parse(date('Y-m-d', strtotime($month)))->subDay($month_first_day)->format('Y-m-d');
        $calenders = [];
        for ($i = 0; $i < 35; $i++) {
            $calenders[] = [
                'date'      => Carbon::parse($date)->format('d/m/Y'),
                'booked'    => Ticket::whereDate('created_at', $date)->get()->reject(function ($ticket) {
                    return $ticket->payment_status != 'paid';
                })->count(),
                'bought'    => Ticket::whereDate('date', $date)->get()->reject(function ($ticket) {
                    return $ticket->payment_status != 'paid';
                })->count(),
            ];
            $date = Carbon::parse($date)->addDay()->format('Y-m-d');
        }

        $params = [
            'days'      => $days,
            'calenders' => $calenders,
            'users'     => $users,
            'tickets'   => $tickets,
            'new_users' => $new_users,
            'filter'    => [
                'month'  => $month
            ]
        ];

     //   dd($calenders);

        return view('dashboard.dashboard', $params);
    }

    /**
     * Show the application settings.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings()
    {
        return view('dashboard.settings');
    }
}
