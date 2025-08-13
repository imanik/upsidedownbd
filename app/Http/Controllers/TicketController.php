<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Refund;
use App\Models\Reschedule;
use App\Models\Ticket;
use App\Models\TicketSlot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $branch_id = $user->branch_id ?? $request->branch;
        $customer_id = $request->customer;

        $tickets = Ticket::when($start_date, function ($query, $start_date) {
            $query->whereDate('date', '>=', $start_date);
        })
        ->when($end_date, function ($query, $end_date) {
            $query->whereDate('date', '<=', $end_date);
        })
        ->when($branch_id, function ($query, $branch_id) {
            $query->where('branch_id', $branch_id);
        })
        ->when($customer_id, function ($query, $customer_id) {
            $query->where('customer_id', $customer_id);
        })
        ->latest()
        ->get();

        // $incomes = 0;
        // foreach ($tickets as $ticket) {
        //     foreach ($ticket->payments as $payment) {
        //         $incomes += $payment->amount;
        //     }
        // }
        $params = [
            'tickets'   => $tickets,
            // 'incomes'   => $incomes,
            'branches'  => Branch::all(),
            'filter'    => [
                'start_date' => $request->start_date,
                'end_date'  => $request->end_date,
                'branch'    => $request->branch,
                'customer'  => $request->customer ? User::find($request->customer) : null,
            ],
        ];
        return view('dashboard.ticket.index', $params);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function check(Request $request)
    {

        if ($request->search) {
            $ticket = Ticket::where('reference', $request->search)->first();
            if ($ticket) {
                return redirect()->route('ticket.ticket_edit', $ticket);
            }

            $customer = User::where('mobile', $request->search)->first();

            if ($customer) {
                $ticket = Ticket::where('customer_id', $customer->id)->where('status', 'not-visited')->where('payment_status', 'paid')->latest()->first();
                return redirect()->route('ticket.index', ['customer' => $customer]);
            }

            return back()->withInput()->with('fail', 'Ticket not found!!!');
        }
        return view('dashboard.ticket.check');
    }

    /**
     * Display the specified resource.
     *
     * @param  Ticket  $ticket
     * @return Response
     */
    public function show(Ticket $ticket)
    {

        $params = [
            'ticket' => $ticket,
            'branch' => $ticket->branch,
        ];
        return view('dashboard.ticket.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ticket  $ticket
     * @return Response
     */
    public function edit(Ticket $ticket)
    {
        $ticket->branch;
        $ticket->facility;
        $ticket->slot;
        $ticket->slots;
        $ticket->customer;
        $params = [
            'slots'                 => TicketSlot::with('slot')->whereDate('date', Carbon::parse($ticket->date)->format('Y-m-d'))->get(),
            'ticket'                => $ticket,
            'branch'                => $ticket->branch,
            'branches'              => Branch::all(),
            'volunteers'            => $ticket->branch->volunteers,
            'facilities'            => $ticket->branch->facilities,
            'facility_providers'    => $ticket->branch->facility_providers,
        ];

        return view('dashboard.ticket.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Ticket  $ticket
     * @return Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'date'              => ['required', 'string', 'max:191'],
            'slot'              => ['required', 'string', 'max:191'],
            'status'            => ['nullable', 'string', 'max:191'],
            'photos_link'       => ['nullable', 'string', 'max:191'],
            'volunteer'         => ['nullable', 'string', 'max:191'],
            'facility_provider' => ['nullable', 'string', 'max:191'],
        ]);

        $change_date        = $request->date;
        $changed_slot_id    = $request->slot;
        $previous_date      = $ticket->date;
        $previous_slot_id   = $ticket->slot_id;

        DB::beginTransaction();
        $ticket->date                   = $change_date;
        $ticket->slot_id                = $changed_slot_id;
        $ticket->status                 = $request->status ?? $ticket->status;
        $ticket->photos_link            = $request->photos_link;
        $ticket->volunteer_id           = $request->volunteer;
        $ticket->facility_provider_id   = $request->facility_provider;

        if (!$ticket->save()) {
            return back()->withInput()->with('fail', __('Ticket modification request failed!'));
        }

        if ($previous_date != $change_date || $previous_slot_id != $changed_slot_id) {
            foreach ($ticket->slots as $ticket_slot) {
                $ticket_slot->status = 'free';
                $ticket_slot->ticket_id = null;
                $ticket_slot->save();
            }

            $slot = $changed_slot_id;
            $slot_reservation_loop = ceil(($ticket->regular_ticket_count + $ticket->child_ticket_count - 2) / 5);
            $slot_reservation_loop = $slot_reservation_loop > 0 ? $slot_reservation_loop : 1;

            for ($i = 0; $i < $slot_reservation_loop; $i++) {
                $ticket_slot = TicketSlot::where('branch_id', $ticket->branch->id)->where('slot_id', $slot + $i)->whereDate('date', $change_date)->first();
                if ($ticket_slot->status == 'free') {
                    $ticket_slot->status = 'booked';
                    $ticket_slot->ticket_id = $ticket->id;
                    $ticket_slot->save();
                } else {
                    DB::rollBack();
                    return back()->withInput()->with('fail', __('Slot is booked. Choose another slot.'));
                }
            }
            $reschedule = new Reschedule;
            $reschedule->previous_date      = $previous_date;
            $reschedule->change_date        = $change_date;
            $reschedule->previous_slot_id   = $previous_slot_id;
            $reschedule->changed_slot_id    = $changed_slot_id;
            $reschedule->ticket_id          = $ticket->id;

            if (!$reschedule->save()) {
                DB::rollBack();
                return back()->withInput()->with('fail', __('Ticket rescheduling failed!'));
            }
        }
        DB::commit();
        return back()->with('success', __('Ticket modified successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ticket  $ticket
     * @return Response
     */
    public function ticket_edit(Ticket $ticket)
    {
        $params = [
            'ticket'                => $ticket,
            'branch'                => $ticket->branch,
            'facility_providers'    => $ticket->branch->facility_providers,
            'volunteers'            => $ticket->branch->volunteers,
            'facilities'            => $ticket->branch->facilities,
        ];
        return view('dashboard.ticket.ticket-edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Ticket  $ticket
     * @return Response
     */
    public function ticket_update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status'            => ['nullable', 'string', 'max:191'],
            'photos_link'       => ['nullable', 'string', 'max:191'],
            'volunteer'         => ['nullable', 'string', 'max:191'],
            'facility_provider' => ['nullable', 'string', 'max:191'],
        ]);

        DB::beginTransaction();
        $ticket->visited_at             = now();
        $ticket->status                 = $request->status ?? $ticket->status;
        $ticket->is_hold                = $request->is_hold == 'on';
        $ticket->photos_link            = $request->photos_link;
        $ticket->volunteer_id           = $request->volunteer;
        $ticket->facility_provider_id   = $request->facility_provider;

        if (!$ticket->save()) {
            DB::rollBack();
            return back()->withInput()->with('fail', __('Ticket modification request failed!'));
        }
        DB::commit();
        return back()->with('success', __('Ticket modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ticket  $ticket
     * @return Response
     */
    public function destroy(Ticket $ticket)
    {
        if (!$ticket->delete()) {
            return back()->withInput()->with('fail', __('Ticket removing request failed!'));
        }
        return back()->with('success', __('Ticket removed successfully'));
    }

    public function refund(Ticket $ticket)
    {
        if ($ticket->refund) {
            return back()->with('success', __('Already requested for refund!'));
        }
        $refund = new Refund;
        $refund->status         = 'pending';
        $refund->refunded_at    = now();
        $refund->ticket_id      = $ticket->id;

        if (!$refund->save()) {
            return back()->withInput()->with('fail', __('Ticket refund request failed!'));
        }
        return back()->with('success', __('Ticket refund request successfully'));
    }
}
