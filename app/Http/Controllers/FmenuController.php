<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Fmenu;
use App\Models\Fcategory;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FmenuController extends Controller
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
        $fmenus = new Fmenu;
        if ($user->branch_id) {
            $fmenus = $fmenus->where('branch_id', $user->branch_id);
        } else if ($request->branch) {
            $fmenus = $fmenus->where('branch_id', $request->branch);
        }
        $fmenus = $fmenus->latest()->get();
        $params = [
            'fmenus'   => $fmenus,
            'branches'  => Branch::all(),
            'filter'    => [
                'branch'    => $request->branch,
            ],
        ];
        return view('dashboard.fmenu.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $branches = Branch::latest()->get();

        $fcategories = Fcategory::latest()->get();

        $branch_box = $branches->map(function ($branch) {
            return [
                'branch_id' => $branch->id,
                'branch'    => $branch,
            ];
        })->toArray();



        $fcategory_box = Fcategory::all()->map(function ($fcategory) {
            return [
                'fcategory_id' => $fcategory->id,
                'fcategory'    => $fcategory,
            ];
        })->toArray();


        $params = [
            'branches'          => $branches,
            'fcategories'       => $fcategories,
            'branch_box'        => array_column($branch_box, 'branch', 'branch_id'),
            'fcategory_box'     => array_column($fcategory_box, 'fcategory', 'fcategory_id'),
    //        'fcategories_box'   => array_column($facilities_box, 'fcategories', 'branch_id'),
        ];
        return view('dashboard.fmenu.create', $params);
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
            'item_number'  => ['required', 'string', 'max:191'],
        //    'child_number'  => ['required', 'string', 'max:191'],
            'normal_price'  => ['required', 'string', 'max:191'],
            'offer_price'   => ['required', 'string', 'max:191'],
            'branch'        => ['required', 'string', 'max:191'],
            'fcategory'      => ['required', 'string', 'max:191'],
        ]);

        $fmenu                         = new Fmenu;
        $fmenu->title                  = $request->title;
        $fmenu->subtitle               = $request->subtitle;
        $fmenu->description            = $request->description;
        $fmenu->item_count             = $request->item_number;
    //    $fmenu->child_ticket_count     = $request->child_number;
        $fmenu->normal_price           = $request->normal_price;
        $fmenu->offer_price            = $request->offer_price;
        $fmenu->branch_id              = $request->branch;
        $fmenu->item_type               = $request->fcategory;

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $extension = $request->photo->extension();
                $file_name = $fmenu->branch->name . '-' . Str::slug($fmenu->title, '-') . '.' . $extension;
                $fmenu->photo = $request->photo->storeAs('photos', $file_name, 'public');
            }
        }

        if (!$fmenu->save()) {
            return back()->withInput()->with('fail', __('Fmenu creation request failed!'));
        }
        return back()->with('success', __('Fmenu added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Fmenu  $fmenu
     * @return Response
     */
    public function show(Fmenu $fmenu)
    {
        $params = [
            'fmenu' => $fmenu
        ];
        return view('dashboard.fmenu.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Fmenu  $fmenu
     * @return Response
     */
    public function edit(Fmenu $fmenu)
    {
        $branches = Branch::latest()->get();
        $fcategories = Fcategory::latest()->get();

        $branch_box = $branches->map(function ($branch) {
            return [
                'branch_id' => $branch->id,
                'branch'    => $branch,
            ];
        })->toArray();

        $fcategory_box = Fcategory::all()->map(function ($fcategory) {
            return [
                'fcategory_id' => $fcategory->id,
                'fcategory'    => $fcategory,
            ];
        })->toArray();


        $params = [
            'fmenu'             => $fmenu,
            'branches'          => $branches,
            'fcategories'       => $fcategories,
            'branch_box'        => array_column($branch_box, 'branch', 'branch_id'),
            'fcategory_box'     => array_column($fcategory_box, 'fcategory', 'fcategory_id'),
        ];
        return view('dashboard.fmenu.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Fmenu  $fmenu
     * @return Response
     */
    public function update(Request $request, Fmenu $fmenu)
    {
        $request->validate([
            'title'         => ['required', 'string', 'max:191'],
            'subtitle'      => ['required', 'string', 'max:191'],
            'photo'         => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'description'   => ['nullable', 'string', 'max:191'],
            'item_number'  => ['required', 'string', 'max:191'],
        //    'child_number'  => ['required', 'string', 'max:191'],
            'normal_price'  => ['required', 'string', 'max:191'],
            'offer_price'   => ['required', 'string', 'max:191'],
            'branch'        => ['required', 'string', 'max:191'],
            'fcategory'      => ['required', 'string', 'max:191'],
        ]);

        $fmenu->title                  = $request->title;
        $fmenu->subtitle               = $request->subtitle;
        $fmenu->description            = $request->description;
        $fmenu->item_count             = $request->item_number;
    //    $fmenu->child_ticket_count     = $request->child_number;
        $fmenu->normal_price           = $request->normal_price;
        $fmenu->offer_price            = $request->offer_price;
        $fmenu->branch_id              = $request->branch;
        $fmenu->item_type              = $request->fcategory;

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $extension = $request->photo->extension();
                $file_name = $fmenu->branch->name . '-' . Str::slug($fmenu->title, '-') . '.' . $extension;
                $fmenu->photo = $request->photo->storeAs('photos', $file_name, 'public');
            }
        } else if ($request->photo_status == 'removed' && $fmenu->photo) {
            unlink(storage_path('app/public/' . $fmenu->photo));
            $fmenu->photo = null;
        }

        if (!$fmenu->save()) {
            return back()->withInput()->with('fail', __('Fmenu modification request failed!'));
        }
        return back()->with('success', __('Fmenu modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Fmenu  $fmenu
     * @return Response
     */
    public function destroy(Fmenu $fmenu)
    {
        if (!$fmenu->delete()) {
            return back()->withInput()->with('fail', __('Fmenu removing request failed!'));
        }
        return back()->with('success', __('Fmenu removed successfully'));
    }
}
