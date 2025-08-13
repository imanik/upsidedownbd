<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Reschedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RescheduleController extends Controller
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
        $reschedules = new Reschedule;
        if ($user->branch_id) {
            $reschedules = $reschedules->where('branch_id', $user->branch_id);
        } else if ($request->branch) {
            $reschedules = $reschedules->where('branch_id', $request->branch);
        }
        $reschedules = $reschedules->latest()->get();
        $params = [
            'reschedules'   => $reschedules,
            'branches'      => Branch::all(),
            'filter'        => [
                'branch'    => $request->branch,
            ],
        ];
        return view('dashboard.reschedule.index', $params);
    }

    /**
     * Display the specified resource.
     *
     * @param  Reschedule  $reschedule
     * @return Response
     */
    public function show(Reschedule $reschedule)
    {
        $params = [
            'reschedule' => $reschedule
        ];
        return view('dashboard.reschedule.show', $params);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reschedule  $reschedule
     * @return Response
     */
    public function destroy(Reschedule $reschedule)
    {
        if (!$reschedule->delete()) {
            return back()->withInput()->with('fail', __('Reschedule removing request failed!'));
        }
        return back()->with('success', __('Reschedule removed successfully'));
    }
}
