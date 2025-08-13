<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
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
        $facilities = new Facility;
        if ($user->branch_id) {
            $facilities = $facilities->where('branch_id', $user->branch_id);
        } else if ($request->branch) {
            $facilities = $facilities->where('branch_id', $request->branch);
        }
        $facilities = $facilities->latest()->get();
        $params = [
            'facilities'    => $facilities,
            'branches'      => Branch::all(),
            'filter'        => [
                'branch'    => $request->branch,
            ],
        ];
        return view('dashboard.facility.index', $params);
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
        return view('dashboard.facility.create', $params);
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
            'branch_id' => ['required', 'string', 'max:191'],
            'title'     => ['required', 'string', 'max:191'],
            'cost'      => ['required', 'string', 'max:191'],
        ]);

        $facility           = new Facility;
        $facility->branch_id    = $request->branch_id;
        $facility->title        = $request->title;
        $facility->cost         = $request->cost;
        if (!$facility->save()) {
            return back()->withInput()->with('fail', __('Facility creation request failed!'));
        }
        return back()->with('success', __('Facility added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Facility  $facility
     * @return Response
     */
    public function show(Facility $facility)
    {
        $params = [
            'facility' => $facility
        ];
        return view('dashboard.facility.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Facility  $facility
     * @return Response
     */
    public function edit(Facility $facility)
    {
        $params = [
            'facility' => $facility,
            'branches'  => Branch::all()
        ];
        return view('dashboard.facility.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Facility  $facility
     * @return Response
     */
    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'branch_id' => ['required', 'string', 'max:191'],
            'title'     => ['required', 'string', 'max:191'],
            'cost'      => ['required', 'string', 'max:191'],
        ]);

        $facility->branch_id    = $request->branch_id;
        $facility->title        = $request->title;
        $facility->cost         = $request->cost;
        if (!$facility->save()) {
            return back()->withInput()->with('fail', __('Facility modification request failed!'));
        }
        return back()->with('success', __('Facility modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Facility  $facility
     * @return Response
     */
    public function destroy(Facility $facility)
    {
        if (!$facility->delete()) {
            return back()->withInput()->with('fail', __('Facility removing request failed!'));
        }
        return back()->with('success', __('Facility removed successfully'));
    }
}
