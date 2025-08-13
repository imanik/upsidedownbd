<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Slot;
use App\Models\TicketSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlotController extends Controller
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
        $slots = new Slot;
        if ($user->branch_id) {
            $slots = $slots->where('branch_id', $user->branch_id);
        } else if ($request->branch) {
            $slots = $slots->where('branch_id', $request->branch);
        }
        $slots = $slots->latest()->get();
        $params = [
            'slots'     => $slots,
            'branches'  => Branch::all(),
            'filter'    => [
                'branch'    => $request->branch,
            ],
        ];
        return view('dashboard.slot.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $params = [
            'branches'  => Branch::all()
        ];
        return view('dashboard.slot.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:191'],
            'branch'    => ['required', 'string', 'max:191'],
            'time'      => ['nullable', 'string', 'max:191'],
            'status'    => ['nullable', 'string', 'max:191'],
        ]);

        $slot           = new Slot;
        $slot->name         = $request->name;
        $slot->time         = $request->time;
        $slot->branch_id    = $request->branch;
        $slot->status       = $request->status;
        if (!$slot->save()) {
            return back()->withInput()->with('fail', __('Slot creation request failed!'));
        }
        return back()->with('success', __('Slot added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Slot  $slot
     * @return Response
     */
    public function show(Slot $slot)
    {
        $params = [
            'slot' => $slot
        ];
        return view('dashboard.slot.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Slot  $slot
     * @return Response
     */
    public function edit(Slot $slot)
    {
        $params = [
            'slot'      => $slot,
            'branches'  => Branch::all()
        ];
        return view('dashboard.slot.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Slot  $slot
     * @return Response
     */
    public function update(Request $request, Slot $slot)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:191'],
            'branch'    => ['required', 'string', 'max:191'],
            'time'      => ['nullable', 'string', 'max:191'],
            'status'    => ['nullable', 'string', 'max:191'],
        ]);

        $slot->name         = $request->name;
        $slot->time         = $request->time;
        $slot->branch_id    = $request->branch;
        $slot->status       = $request->status;
        if (!$slot->save()) {
            return back()->withInput()->with('fail', __('Slot modification request failed!'));
        }
        return back()->with('success', __('Slot modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Slot  $slot
     * @return Response
     */
    public function destroy(Slot $slot)
    {
        if (!$slot->delete()) {
            return back()->withInput()->with('fail', __('Slot removing request failed!'));
        }
        return back()->with('success', __('Slot removed successfully'));
    }
}
