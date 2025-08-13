<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Bundle;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BundleController extends Controller
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
        $bundles = new Bundle;
        if ($user->branch_id) {
            $bundles = $bundles->where('branch_id', $user->branch_id);
        } else if ($request->branch) {
            $bundles = $bundles->where('branch_id', $request->branch);
        }
        $bundles = $bundles->latest()->get();
        $params = [
            'bundles'   => $bundles,
            'branches'  => Branch::all(),
            'filter'    => [
                'branch'    => $request->branch,
            ],
        ];
        return view('dashboard.bundle.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $branches = Branch::latest()->get();
        $branch_box = $branches->map(function ($branch) {
            return [
                'branch_id' => $branch->id,
                'branch'    => $branch,
            ];
        })->toArray();
        $facility_box = Facility::all()->map(function ($facility) {
            return [
                'facility_id' => $facility->id,
                'facility'    => $facility,
            ];
        })->toArray();

        $facilities_box = $branches->map(function ($branch) {
            return [
                'branch_id'     => $branch->id,
                'facilities'    => $branch->facilities,
            ];
        })->toArray();

        $params = [
            'branches'          => $branches,
            'branch_box'        => array_column($branch_box, 'branch', 'branch_id'),
            'facility_box'      => array_column($facility_box, 'facility', 'facility_id'),
            'facilities_box'    => array_column($facilities_box, 'facilities', 'branch_id'),
        ];
        return view('dashboard.bundle.create', $params);
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
            'title'         => ['required', 'string', 'max:191'],
            'subtitle'      => ['required', 'string', 'max:191'],
            'photo'         => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'description'   => ['nullable', 'string', 'max:191'],
            'adult_number'  => ['required', 'string', 'max:191'],
            'child_number'  => ['required', 'string', 'max:191'],
            'normal_price'  => ['required', 'string', 'max:191'],
            'offer_price'   => ['required', 'string', 'max:191'],
            'branch'        => ['required', 'string', 'max:191'],
            'facility'      => ['nullable', 'string', 'max:191'],
        ]);

        $bundle                         = new Bundle;
        $bundle->title                  = $request->title;
        $bundle->subtitle               = $request->subtitle;
        $bundle->description            = $request->description;
        $bundle->regular_ticket_count   = $request->adult_number;
        $bundle->child_ticket_count     = $request->child_number;
        $bundle->normal_price           = $request->normal_price;
        $bundle->offer_price            = $request->offer_price;
        $bundle->branch_id              = $request->branch;
        $bundle->facility_id            = $request->facility;

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $extension = $request->photo->extension();
                $file_name = $bundle->branch->name . '-' . Str::slug($bundle->title, '-') . '.' . $extension;
                $bundle->photo = $request->photo->storeAs('photos', $file_name, 'public');
            }
        }

        if (!$bundle->save()) {
            return back()->withInput()->with('fail', __('Bundle creation request failed!'));
        }
        return back()->with('success', __('Bundle added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Bundle  $bundle
     * @return Response
     */
    public function show(Bundle $bundle)
    {
        $params = [
            'bundle' => $bundle
        ];
        return view('dashboard.bundle.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Bundle  $bundle
     * @return Response
     */
    public function edit(Bundle $bundle)
    {
        $branches = Branch::latest()->get();
        $branch_box = $branches->map(function ($branch) {
            return [
                'branch_id' => $branch->id,
                'branch'    => $branch,
            ];
        })->toArray();
        $facility_box = Facility::all()->map(function ($facility) {
            return [
                'facility_id' => $facility->id,
                'facility'    => $facility,
            ];
        })->toArray();

        $facilities_box = $branches->map(function ($branch) {
            return [
                'branch_id'     => $branch->id,
                'facilities'    => $branch->facilities,
            ];
        })->toArray();

        $params = [
            'bundle'            => $bundle,
            'branches'          => $branches,
            'branch_box'        => array_column($branch_box, 'branch', 'branch_id'),
            'facility_box'      => array_column($facility_box, 'facility', 'facility_id'),
            'facilities_box'    => array_column($facilities_box, 'facilities', 'branch_id'),
        ];
        return view('dashboard.bundle.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Bundle  $bundle
     * @return Response
     */
    public function update(Request $request, Bundle $bundle)
    {
        $request->validate([
            'title'         => ['required', 'string', 'max:191'],
            'subtitle'      => ['required', 'string', 'max:191'],
            'photo'         => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'description'   => ['nullable', 'string', 'max:191'],
            'adult_number'  => ['required', 'string', 'max:191'],
            'child_number'  => ['required', 'string', 'max:191'],
            'normal_price'  => ['required', 'string', 'max:191'],
            'offer_price'   => ['required', 'string', 'max:191'],
            'branch'        => ['required', 'string', 'max:191'],
            'facility'      => ['nullable', 'string', 'max:191'],
        ]);

        $bundle->title                  = $request->title;
        $bundle->subtitle               = $request->subtitle;
        $bundle->description            = $request->description;
        $bundle->regular_ticket_count   = $request->adult_number;
        $bundle->child_ticket_count     = $request->child_number;
        $bundle->normal_price           = $request->normal_price;
        $bundle->offer_price            = $request->offer_price;
        $bundle->branch_id              = $request->branch;
        $bundle->facility_id            = $request->facility;

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $extension = $request->photo->extension();
                $file_name = $bundle->branch->name . '-' . Str::slug($bundle->title, '-') . '.' . $extension;
                $bundle->photo = $request->photo->storeAs('photos', $file_name, 'public');
            }
        } else if ($request->photo_status == 'removed' && $bundle->photo) {
            unlink(storage_path('app/public/' . $bundle->photo));
            $bundle->photo = null;
        }

        if (!$bundle->save()) {
            return back()->withInput()->with('fail', __('Bundle modification request failed!'));
        }
        return back()->with('success', __('Bundle modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bundle  $bundle
     * @return Response
     */
    public function destroy(Bundle $bundle)
    {
        if (!$bundle->delete()) {
            return back()->withInput()->with('fail', __('Bundle removing request failed!'));
        }
        return back()->with('success', __('Bundle removed successfully'));
    }
}
