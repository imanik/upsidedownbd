<?php

namespace App\Http\Controllers;

use App\Models\Fcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FcategoryController extends Controller
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
        $fcategories = Fcategory::latest()->get();
        $params = [
            'fcategories' => $fcategories,
        ];
        return view('dashboard.fcategory.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.fcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
    //    $statuses = implode(",", config('upsidedown.fcategory.statuses'));

        $request->validate([
            'name'          => ['required', 'string', 'max:191'],

        ]);

        $fcategory                 = new Fcategory;
        $fcategory->name           = $request->name;

        if (!$fcategory->save()) {
            return back()->withInput()->with('fail', __('Category creation request failed!'));
        }
        return back()->with('success', __('Category added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Fcategory  $fcategory
     * @return Response
     */
    public function show(Fcategory $fcategory)
    {
        $params = [
            'fcategory' => $fcategory
        ];
        return view('dashboard.fcategory.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Fcategory  $fcategory
     * @return Response
     */
    public function edit(Fcategory $fcategory)
    {
        $params = [
            'fcategory' => $fcategory
        ];
        return view('dashboard.fcategory.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Fcategory  $fcategory
     * @return Response
     */
    public function update(Request $request, Fcategory $fcategory)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:191'],

        ]);

        $fcategory->name           = $request->name;

        if (!$fcategory->save()) {
            return back()->withInput()->with('fail', __('Category modification request failed!'));
        }
        return back()->with('success', __('Category modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Fcategory  $fcategory
     * @return Response
     */
    public function destroy(Fcategory $fcategory)
    {
        if (!$fcategory->delete()) {
            return back()->withInput()->with('fail', __('Category removing request failed!'));
        }
        return back()->with('success', __('Category removed successfully'));
    }
}
