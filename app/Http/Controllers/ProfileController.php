<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
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
     * Show the application profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.profile', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'address'   => ['required', 'string', 'max:191'],
            'name'      => ['required', 'string', 'max:191'],
            'mobile'    => ['required', 'string', 'max:13', 'min:11'],
            'email'     => ['required', 'string', 'email', 'max:191', Rule::unique('users')->ignore($user->id)],
            'photo'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
        $user->address  = $request->address;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->mobile   = $request->mobile;

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
        } else if ($request->photo_status == 'removed' && $user->photo) {
            unlink(storage_path('app/public/thumbnails/' . $user->photo));
            unlink(storage_path('app/public/' . $user->photo));
            $user->photo = null;
        }

        if (!$user->save()) {
            return back()->withInput()->with('fail', __('Profile modification request failed!'));
        }
        return back()->with('success', __('Profile modified successfully'));
    }

    /**
     * Show the application profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function password()
    {
        return view('dashboard.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return Response
     */
    public function passwordUpdate(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'current_password'  => ['required', 'string'],
        ]);

        $user->password = Hash::make($request->password);

        if (!$user->save()) {
            return back()->withInput()->with('fail', __('Password modification request failed!'));
        }
        return back()->with('success', __('Password modified successfully'));
    }
}
