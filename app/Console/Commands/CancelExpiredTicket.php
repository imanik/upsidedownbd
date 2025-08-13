<?php

namespace App\Console\Commands;

use App\Helpers;
use App\Mail\TicketBookingCanceled;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CancelExpiredTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:cancelExpiredTicket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Ticket payment in 24 Hours if not then releasing slots from ticket booking';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expired_ticket_time = Carbon::now()->subHour()->subMinutes(15);
        $tickets = Ticket::where('status', 'not-visited')->where('is_hold', false)->where('payment_status', 'unpaid')->get()->filter(function($ticket) use ($expired_ticket_time){
            return $expired_ticket_time->gt(Carbon::parse($ticket->created_at));
        });

        foreach ($tickets as $ticket) {

            foreach ($ticket->slots as $slot) {
                $slot->status = 'free';
                $slot->ticket_id = null;
                $slot->save();
            }
            $ticket->delete();

            $customer_email = optional($ticket->customer)->email;

            $params = [
                'message'   => 'Dear ' . optional($ticket->customer)->name . ', your booked ticket canceled ref#' . $ticket->reference,
            ];

            $admin_emails = Helpers::getAdminEmailList($ticket->branch_id);

            Mail::to($customer_email)->bcc($admin_emails)->send(new TicketBookingCanceled($params));
        }
    }
}
