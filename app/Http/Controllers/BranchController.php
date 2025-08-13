<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BranchController extends Controller
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
        $branches = Branch::latest()->get();
        $params = [
            'branches' => $branches,
        ];
        return view('dashboard.branch.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $statuses = implode(',', config('upsidedown.branch.statuses'));

        $request->validate([
            'name'          => ['required', 'string', 'max:191'],
            'status'        => ['required', 'in:' . $statuses],
            'mobile'        => ['required', 'digits_between:11,13'],
            'address'       => ['nullable', 'string', 'max:191'],
            'child_price'   => ['required', 'numeric', 'min:0'],
            'regular_price' => ['required', 'numeric', 'min:0'],
        ]);

        $branch                 = new Branch;
        $branch->name           = $request->name;
        $branch->status         = $request->status;
        $branch->mobile         = $request->mobile;
        $branch->address        = $request->address;
        $branch->child_price    = $request->child_price;
        $branch->regular_price  = $request->regular_price;

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {

                $thumbnail_path = storage_path('app/public/thumbnails/photos');
                Storage::makeDirectory('thumbnails/photos/');

                $extension = $request->photo->extension();
                $file_name = $branch->id . '-' . Str::slug($branch->name, '-') . '.' . $extension;
                $photo_path = $request->photo->storeAs('photos', $file_name, 'public');

                Image::make(Storage::path($photo_path))->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnail_path . '/' . $file_name, 100);

                $branch->photo = $photo_path;
            }
        }

        if (!$branch->save()) {
            return back()->withInput()->with('fail', __('Branch creation request failed!'));
        }
        return back()->with('success', __('Branch added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Branch  $branch
     * @return Response
     */
    public function show(Branch $branch)
    {
        $params = [
            'branch' => $branch
        ];
        return view('dashboard.branch.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Branch  $branch
     * @return Response
     */
    public function edit(Branch $branch)
    {
        $params = [
            'branch' => $branch
        ];
        return view('dashboard.branch.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Branch  $branch
     * @return Response
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:191'],
            'status'        => ['nullable', 'string', 'max:191'],
            'mobile'        => ['required', 'string', 'max:191'],
            'address'       => ['nullable', 'string', 'max:191'],
            'child_price'   => ['required', 'string', 'max:20'],
            'regular_price' => ['required', 'string', 'max:191'],
        ]);

        $branch->name           = $request->name;
        $branch->status         = $request->status;
        $branch->mobile         = $request->mobile;
        $branch->address        = $request->address;
        $branch->child_price    = $request->child_price;
        $branch->regular_price  = $request->regular_price;
        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {

                $thumbnail_path = storage_path('app/public/thumbnails/photos');
                Storage::makeDirectory('thumbnails/photos/');

                $extension = $request->photo->extension();
                $file_name = $branch->id . '-' . Str::slug($branch->name, '-') . '.' . $extension;
                $photo_path = $request->photo->storeAs('photos', $file_name, 'public');

                Image::make(Storage::path($photo_path))->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnail_path . '/' . $file_name, 100);

                $branch->photo = $photo_path;
            }
        } else if ($request->photo_status == 'removed' && $branch->photo) {
            unlink(storage_path('app/public/thumbnails/' . $branch->photo));
            unlink(storage_path('app/public/' . $branch->photo));
            $branch->photo = null;
        }

        if (!$branch->save()) {
            return back()->withInput()->with('fail', __('Branch modification request failed!'));
        }
        return back()->with('success', __('Branch modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Branch  $branch
     * @return Response
     */
    public function destroy(Branch $branch)
    {
        if (!$branch->delete()) {
            return back()->withInput()->with('fail', __('Branch removing request failed!'));
        }
        return back()->with('success', __('Branch removed successfully'));
    }
}
