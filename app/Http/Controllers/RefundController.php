<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use Illuminate\Http\Request;

class RefundController extends Controller
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
        $refunds = Refund::latest()->get();
        $params = [
            'refunds' => $refunds,
        ];
        return view('dashboard.refund.index', $params);
    }

    /**
     * Display the specified resource.
     *
     * @param  Refund  $refund
     * @return Response
     */
    public function show(Refund $refund)
    {
        $params = [
            'refund' => $refund
        ];
        return view('dashboard.refund.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Refund  $refund
     * @return Response
     */
    public function edit(Refund $refund)
    {
        $params = [
            'refund' => $refund,
        ];
        return view('dashboard.refund.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Refund  $refund
     * @return Response
     */
    public function update(Request $request, Refund $refund)
    {
        $request->validate([
            'status'    => ['required', 'string', 'max:191'],
        ]);

        $refund->status = $request->status;
        if (!$refund->save()) {
            return back()->withInput()->with('fail', __('Refund modification request failed!'));
        }
        if ($refund->status == 'refunded') {
            foreach ($refund->ticket->slots as $slot) {
                $slot->status = 'free';
                $slot->ticket_id = null;
                $slot->save();
            }
        }
        return back()->with('success', __('Refund modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Refund  $refund
     * @return Response
     */
    public function destroy(Refund $refund)
    {
        if (!$refund->delete()) {
            return back()->withInput()->with('fail', __('Refund removing request failed!'));
        }
        return back()->with('success', __('Refund removed successfully'));
    }
}
