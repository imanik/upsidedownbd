<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\UserBundle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function customer(Request $request)
    {
        if (Auth::user()->is_admin || Auth::user()->role) {
            return redirect()->route('dashboard');
        }

        $params = [
            'tickets' => Ticket::where('customer_id', Auth::id())->count(),
            'bundles' => UserBundle::where('customer_id', Auth::id())->count(),
        ];

        return view('customer.dashboard', $params);
    }

    /**
     * Show the application profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('customer.profile', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return Response
     */
    public function profileUpdate(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'address'   => ['required', 'string', 'max:191'],
            'name'      => ['required', 'string', 'max:191'],
            'mobile'    => ['required', 'string', 'max:13', 'min:11'],
            'photo'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
        $user->address  = $request->address;
        $user->name     = $request->name;
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
        return view('customer.password');
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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function tickets(Request $request)
    {
        $user = Auth::user();

        $tickets = Ticket::where('customer_id', $user->id)->latest()->get();

        $params = [
            'tickets' => $tickets,
        ];
        return view('customer.ticket.index', $params);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function bundles(Request $request)
    {
        $user = Auth::user();
        $bundles = $user->bundles;

        $params = [
            'bundles' => $bundles,
        ];

        return view('customer.bundle.index', $params);
    }
}
