<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
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
        $designations = Designation::latest()->get();
        $params = [
            'designations' => $designations,
        ];
        return view('dashboard.designation.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $params = [];
        return view('dashboard.designation.create', $params);
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
            'title' => ['required', 'string', 'max:191'],
        ]);

        $designation           = new Designation;
        $designation->title        = $request->title;
        if (!$designation->save()) {
            return back()->withInput()->with('fail', __('Designation creation request failed!'));
        }
        return back()->with('success', __('Designation added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Designation  $designation
     * @return Response
     */
    public function show(Designation $designation)
    {
        $params = [
            'designation' => $designation
        ];
        return view('dashboard.designation.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Designation  $designation
     * @return Response
     */
    public function edit(Designation $designation)
    {
        $params = [
            'designation' => $designation,
        ];
        return view('dashboard.designation.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Designation  $designation
     * @return Response
     */
    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'title'     => ['required', 'string', 'max:191'],
        ]);

        $designation->title        = $request->title;
        if (!$designation->save()) {
            return back()->withInput()->with('fail', __('Designation modification request failed!'));
        }
        return back()->with('success', __('Designation modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Designation  $designation
     * @return Response
     */
    public function destroy(Designation $designation)
    {
        if (!$designation->delete()) {
            return back()->withInput()->with('fail', __('Designation removing request failed!'));
        }
        return back()->with('success', __('Designation removed successfully'));
    }
}
