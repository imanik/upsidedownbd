<?php

namespace App\Http\Controllers;

use App\Helpers;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Mail\BundleConfirmed;
use App\Mail\TicketConfirmed;
use App\Models\Branch;
use App\Models\Payment;
use App\Models\TicketPayment;
use App\Models\UserBundlePayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $payments = new Payment;
        $request->date ? $payments = $payments->where('created_at', $request->date) : null;
        if ($user->branch_id) {
            $payments = $payments->where('branch_id', $user->branch_id);
        } else if ($request->branch) {
            $payments = $payments->where('branch_id', $request->branch);
        }

        $payments = $payments->whereIn('status', ['Processing', 'Complete'])->latest()->get();

        $params     = [
            'branches'  => Branch::all(),
            'payments'  => $payments,
            'filter'    => [
                'date'      => $request->date,
                'branch'    => $request->branch,
            ],
        ];
        return view('dashboard.payment.index', $params);
    }

    /**
     * Display the specified resource.
     *
     * @param  Payment  $payment
     * @return Response
     */
    public function show(Payment $payment)
    {
        $params = [
            'payment' => $payment
        ];
        return view('dashboard.payment.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Payment  $payment
     * @return Response
     */
    public function edit(Payment $payment)
    {
        $params = [
            'payment' => $payment,
        ];
        return view('dashboard.payment.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Payment  $payment
     * @return Response
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'branch_id' => ['required', 'string', 'max:191'],
            'title'     => ['required', 'string', 'max:191'],
            'cost'      => ['required', 'string', 'max:191'],
        ]);

        $payment->branch_id    = $request->branch_id;
        $payment->title        = $request->title;
        $payment->cost         = $request->cost;
        if (!$payment->save()) {
            return back()->withInput()->with('fail', __('Payment modification request failed!'));
        }
        return back()->with('success', __('Payment modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Payment  $payment
     * @return Response
     */
    public function destroy(Payment $payment)
    {
        if (!$payment->delete()) {
            return back()->withInput()->with('fail', __('Payment removing request failed!'));
        }
        return back()->with('success', __('Payment removed successfully'));
    }

    public static function getPaymentPostData()
    {
        # Here you have to receive all the order data to initiate the payment.
        # Let's say, your oder transaction information are saving in a table called 'orders'
        # In 'orders' table, order unique identity is 'tran_id'. 'status' field contain status of the transaction, 'amount' is the order amount to be paid and 'currency' is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount']      = 10; # You cant not pay less than 10
        $post_data['currency']          = 'BDT';
        $post_data['tran_id']           = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name']          = '';
        $post_data['cus_email']         = '';
        $post_data['cus_add1']          = 'Dhaka';
        $post_data['cus_add2']          = 'Dhaka';
        $post_data['cus_city']          = 'Dhaka';
        $post_data['cus_state']         = 'Dhaka';
        $post_data['cus_postcode']      = '1200';
        $post_data['cus_country']       = 'Bangladesh';
        $post_data['cus_phone']         = '';
        $post_data['cus_fax']           = '';

        # SHIPMENT INFORMATION
        $post_data['ship_name']         = 'Store';
        $post_data['ship_add1']         = 'Dhaka';
        $post_data['ship_add2']         = 'Dhaka';
        $post_data['ship_city']         = 'Dhaka';
        $post_data['ship_state']        = 'Dhaka';
        $post_data['ship_postcode']     = '1000';
        $post_data['ship_phone']        = '';
        $post_data['ship_country']      = 'Bangladesh';

        $post_data['shipping_method']   = 'NO';
        $post_data['product_name']      = '';
        $post_data['product_category']  = 'Service';
        $post_data['product_profile']   = 'visiting';

        return $post_data;
    }

    public function pay(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        if(!$payment) {
            return back()->with('fail', __('Payment initiating failed! please try again.'));
        }

        $ticket_payment = TicketPayment::where('payment_id', $payment->id)->latest()->first();
        $user_bundle_payment = UserBundlePayment::where('payment_id', $payment->id)->latest()->first();

        if($user_bundle_payment) {
            if(!$user_bundle_payment->user_bundle) {
                return back()->with('fail', __('Payment initiating failed! may be your booking bundle ticket expired.'));
            }
        }else if(!$ticket_payment || !optional($ticket_payment)->ticket) {
            return redirect()->route('ticket.create')->with('fail', __('Payment initiating failed! may be your booking ticket expired.'));
        }

        $payment->status = 'Initiated';
        $post_data = json_decode($payment->post_data, true);

        if ($payment->save()) {
            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payment gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');
            // $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        }
        return back()->with('fail', __('Payment initiating failed!'));
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $payment = Payment::where('tran_id', $tran_id)->select('id', 'tran_id', 'status', 'currency', 'amount')->first();

        $ticket_payment = TicketPayment::where('payment_id', $payment->id)->latest()->first();
        // $user_bundle_payment = BundlePayment::where('payment_id', $payment->id)->latest()->first();

        if ($ticket_payment && $ticket_payment->ticket) {
            $reference = $ticket_payment->ticket->reference;
            $customer = $ticket_payment->ticket->customer;
            $branch = $ticket_payment->ticket->branch;
            $route = 'ticket.detail';
            // } else if ($user_bundle_payment && $user_bundle_payment->user_bundle) {
            //     $reference = $user_bundle_payment->user_bundle->reference;
            // $customer = $user_bundle_payment->user_bundle->customer;
            // $route = 'bundle.detail';
        } else {
            abort(404);
        }

        $sslc = new SslCommerzNotification();

        if ($payment->status == 'Initiated') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $payment->amount, $payment->currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successful transaction to customer
                */
                Payment::where('tran_id', $tran_id)->update(['status' => 'Complete']);

                if ($ticket_payment && $ticket_payment->ticket) {
                    $ticket_payment->ticket->update(['payment_status' => 'paid']);

                    $customer_email = optional($customer)->email;

                    $params = [
                        'reference' => $reference,
                        'message'   => 'Dear ' . optional($customer)->name . ', go through the link and preserve it.',
                    ];

                    $admin_emails = Helpers::getAdminEmailList($branch->id);

                    Mail::to($customer_email)->bcc($admin_emails)->send(new TicketConfirmed($params));
                }

                // if ($user_bundle_payment && $user_bundle_payment->user_bundle) {
                //     $user_bundle_payment->user_bundle->update(['payment_status' => 'paid']);

                //     $params = [
                //         'reference' => $reference,
                //         'message'   => 'Dear ' . optional($customer)->name . ', go through the link and preserve it.',
                //     ];
                //     $emails = User::where('branch_id', $user_bundle_payment->user_bundle->branch_id)->where('role_id', 1)->orWhere('id', $customer->id)->orWhere('is_admin', true)->pluck('email');

                //     Mail::bcc($emails)->send(new BundleConfirmed($params));
                // }

                return redirect()->route($route, $reference)->with('success', 'Transaction is successfully Completed.');
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transaction validation failed.
                Here you need to update order status as Failed in order table.
                */
                Payment::where('tran_id', $tran_id)->update(['status' => 'Failed']);

                return redirect()->route($route, $reference)->with('fail', 'Validation Fail.');
            }
        } else if ($payment->status == 'Processing' || $payment->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to update database.
             */
            return redirect()->route($route, $reference)->with('success', 'Transaction is successfully Completed.');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            return redirect()->route($route, $reference)->with('fail', 'Invalid Transaction.');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $payment = Payment::where('tran_id', $tran_id)->select('id', 'tran_id', 'status', 'currency', 'amount')->first();

        $ticket_payment = TicketPayment::where('payment_id', $payment->id)->latest()->first();
        // $user_bundle_payment = BundlePayment::where('payment_id', $payment->id)->latest()->first();

        if ($ticket_payment && $ticket_payment->ticket) {
            $reference = $ticket_payment->ticket->reference;
            $route = 'ticket.detail';
            // } else if ($user_bundle_payment && $user_bundle_payment->user_bundle) {
            //     $reference = $user_bundle_payment->user_bundle->reference;
            //     $route = 'bundle.detail';
        } else {
            abort(404);
        }

        if ($payment->status == 'Initiated') {
            Payment::where('tran_id', $tran_id)->update(['status' => 'Failed']);

            return redirect()->route($route, $reference)->with('fail', 'Transaction is Failed.');
        } else if ($payment->status == 'Processing' || $payment->status == 'Complete') {
            return redirect()->route($route, $reference)->with('success', 'Transaction is already Successful.');
        } else {
            return redirect()->route($route, $reference)->with('fail', 'Transaction is Invalid.');
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $payment = Payment::where('tran_id', $tran_id)->select('id', 'tran_id', 'status', 'currency', 'amount')->first();

        $ticket_payment = TicketPayment::where('payment_id', $payment->id)->latest()->first();
        // $user_bundle_payment = BundlePayment::where('payment_id', $payment->id)->latest()->first();

        if ($ticket_payment && $ticket_payment->ticket) {
            $reference = $ticket_payment->ticket->reference;
            $route = 'ticket.detail';
            // } else if ($user_bundle_payment && $user_bundle_payment->user_bundle) {
            //     $reference = $user_bundle_payment->user_bundle->reference;
            //     $route = 'bundle.detail';
        } else {
            abort(404);
        }

        if ($payment->status == 'Initiated') {
            Payment::where('tran_id', $tran_id)->update(['status' => 'Canceled']);

            return redirect()->route($route, $reference)->with('fail', 'Transaction is Cancel.');
        } else if ($payment->status == 'Processing' || $payment->status == 'Complete') {
            return redirect()->route($route, $reference)->with('success', 'Transaction is already Successful.');
        } else {
            return redirect()->route($route, $reference)->with('fail', 'Transaction is Invalid.');
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payment information from the gateway
        #Check Transaction id is posted or not.

        if ($request->input('tran_id')) {

            $tran_id = $request->input('tran_id');

            $payment = Payment::where('tran_id', $tran_id)->select('id', 'tran_id', 'status', 'currency', 'amount')->first();

            $ticket_payment = TicketPayment::where('payment_id', $payment->id)->latest()->first();
            // $user_bundle_payment = BundlePayment::where('payment_id', $payment->id)->latest()->first();

            if ($ticket_payment && $ticket_payment->ticket) {
                $reference = $ticket_payment->ticket->reference;
                $customer = $ticket_payment->ticket->customer;
                $branch = $ticket_payment->ticket->branch;
                // } else if ($user_bundle_payment && $user_bundle_payment->user_bundle) {
                //     $reference = $user_bundle_payment->user_bundle->reference;
                //     $customer = $user_bundle_payment->user_bundle->customer;
            } else {
                echo 'failed';
            }


            if ($payment->status == 'Initiated') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $payment->amount, $payment->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    Payment::where('tran_id', $tran_id)->update(['status' => 'Complete']);

                    if ($ticket_payment && $ticket_payment->ticket) {
                        $ticket_payment->ticket->update(['payment_status' => 'paid']);

                        $customer_email = optional($customer)->email;

                        $params = [
                            'reference' => $reference,
                            'message'   => 'Dear ' . optional($customer)->name . ', go through the link and preserve it.',
                        ];

                        $admin_emails = Helpers::getAdminEmailList($branch->id);

                        Mail::to($customer_email)->bcc($admin_emails)->send(new TicketConfirmed($params));
                    }

                    // if ($user_bundle_payment && $user_bundle_payment->user_bundle) {
                    //     $user_bundle_payment->user_bundle->update(['payment_status' => 'paid']);

                    //     $params = [
                    //         'reference' => $reference,
                    //         'message'   => 'Dear ' . optional($customer)->name . ', go through the link and preserve it.',
                    //     ];
                    //     $emails = User::where('branch_id', $user_bundle_payment->user_bundle->branch_id)->where('role_id', 1)->orWhere('id', $customer->id)->orWhere('is_admin', true)->pluck('email');

                    //     Mail::bcc($emails)->send(new BundleConfirmed($params));
                    // }

                    echo 'Transaction is successfully Completed.';
                } else {
                    /*
                    That means IPN worked, but Transaction validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    Payment::where('tran_id', $tran_id)->update(['status' => 'Failed']);

                    echo 'Validation Fail.';
                }
            } else if ($payment->status == 'Processing' || $payment->status == 'Complete') {
                #That means Order status already updated. No need to update database.

                echo 'Transaction is already successfully Completed.';
            } else {
                #That means something wrong happened. You can redirect customer to your product page.
                echo 'Invalid Transaction.';
            }
        } else {
            echo 'Invalid Data';
        }
    }
}
