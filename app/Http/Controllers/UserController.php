<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
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
        $users = new User;
        if ($user->branch_id) {
            $users = $users->where('branch_id', $user->branch_id);
        } else if ($request->branch) {
            $users = $users->where('branch_id', $request->branch);
        }
        if ($request->role == 'super-admin') {
            $users = $users->where('is_admin', true);
        } else if ($request->role == 'customer') {
            $users = $users->where('is_admin', false)->whereNull('role_id');
        } else if ($request->role) {
            $users = $users->where('role_id', $request->role);
        }
        $users = $users->latest()->get();
        $params = [
            'users'     => $users,
            'branches'  => Branch::all(),
            'roles'     => Role::all(),
            'filter'    => [
                'branch'    => $request->branch,
                'role'      => $request->role,
            ],
        ];
        return view('dashboard.user.index', $params);
    }

    public function auto_login(User $user)
    {
        if (Auth::user()->is_admin) {
            Auth::login($user);
            return redirect()->route('customer.dashboard');
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $params = [
            'branches'  => Branch::all(),
            'roles'     => Role::all(),
        ];
        return view('dashboard.user.create', $params);
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
            'email'     => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'mobile'    => ['nullable', 'string', 'max:191'],
            'password'  => ['required', 'string', 'min:8'],
            'photo'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
        $user = new User;

        $user->is_admin     = $request->role == 'super-admin' ?? 0;
        $user->role_id      = $request->role == 'customer' || $request->role == 'super-admin' ? null : $request->role;
        $user->branch_id    = $request->role == 'customer' || $request->role == 'super-admin' ? null : $request->branch;
        $user->name         = $request->name;
        $user->mobile       = $request->mobile;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->status       = 'active';

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {

                $thumbnail_path = storage_path('app/public/thumbnails/photos');
                Storage::makeDirectory('thumbnails/photos/');

                $extension = $request->photo->extension();
                $file_name = $user->id . '-' . Str::slug($user->name, '-') . '.' . $extension;
                $photo_path = $request->photo->storeAs('photos', $file_name, 'public');

                Image::make(Storage::path($photo_path))->resize(134, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnail_path . '/' . $file_name, 100);

                $user->photo = $photo_path;
            }
        }

        if (!$user->save()) {
            return back()->withInput()->with('fail', __('User creation request failed!'));
        }
        return redirect()->route('user.edit', $user->id)->with('success', __('User added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return Response
     */
    public function show(User $user)
    {
        $params = [
            'user' => $user
        ];
        return view('dashboard.user.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return Response
     */
    public function edit(User $user)
    {
        $params = [
            'branches'  => Branch::all(),
            'roles'     => Role::all(),
            'user'      => $user,
        ];
        return view('dashboard.user.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role'      => ['required', 'string', 'max:191'],
            'branch'    => ['nullable', 'string', 'max:191'],
            'name'      => ['required', 'string', 'max:191'],
            'email'     => ['required', 'string', 'email', 'max:191', Rule::unique('users')->ignore($user->id)],
            'password'  => ['nullable', 'string', 'min:8'],
            'mobile'    => ['nullable', 'string', 'max:191'],
            'status'    => ['required', 'string', 'max:191'],
        ]);

        $user->is_admin     = $request->role == 'super-admin' ?? 0;
        $user->role_id      = $request->role == 'customer' || $request->role == 'super-admin' ? null : $request->role;
        $user->branch_id    = $request->role == 'customer' || $request->role == 'super-admin' ? null : $request->branch;
        $user->name         = $request->name;
        $user->mobile       = $request->mobile;
        $user->status       = $request->status;
        $user->email        = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {

                $thumbnail_path = storage_path('app/public/thumbnails/photos');
                Storage::makeDirectory('thumbnails/photos/');

                $extension = $request->photo->extension();
                $file_name = $user->id . '-' . Str::slug($user->name, '-') . '.' . $extension;
                $photo_path = $request->photo->storeAs('photos', $file_name, 'public');

                Image::make(Storage::path($photo_path))->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnail_path . '/' . $file_name, 100);

                $user->photo = $photo_path;
            }
        } else if ($request->photo_status == 'removed' && $user->photo) {
            unlink(storage_path('app/public/thumbnails/' . $user->photo));
            unlink(storage_path('app/public/' . $user->photo));
            $user->photo = null;
        }

        if (!$user->save()) {
            return back()->withInput()->with('fail', __('User modification request failed!'));
        }
        return back()->with('success', __('User modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return Response
     */
    public function destroy(User $user)
    {
        if (!$user->delete()) {
            return back()->withInput()->with('fail', __('User removing request failed!'));
        }
        return back()->with('success', __('User removed successfully'));
    }
}
