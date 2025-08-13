<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function language()
    {
        if (session()->has('language') && session('language') == 'bn') {
            session(['language' => 'en']);
        } else {
            session(['language' => 'bn']);
        }
        return back();
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        // dd('here1');
        $params = [
            'bundles' => Bundle::all(),
        ];

        return view('frontend.home', $params);
    }

    /**
     * Show the application about us .
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function aboutUs()
    {
        //dd('here1');
        $params = [];

        return view('frontend.about', $params);
    }

    /**
     * Show the application about us .
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function promotions()
    {
        //dd('here1');
        $params = [];

        return view('frontend.promotion', $params);
    }

    /**
     * Show the application about us .
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function gallery()
    {
        //dd('here1');
        $params = [];

        return view('frontend.gallery', $params);
    }
    /**
     * Show the application about us .
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function galleryUttara()
    {
        //dd('here1');
        $params = [];

        return view('frontend.gallery-uttara', $params);
    }
    /**
     * Show the application about us .
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function comingSoon()
    {
        //dd('here1');
        $params = [];

        return view('frontend.coming-soon', $params);
    }

    /**
     * Show the application about us .
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contacts()
    {
        //dd('here1');
        $params = [];

        return view('frontend.contact', $params);
    }
    public function privacy()
    {
        //dd('here1');
        $params = [];

        return view('frontend.privacy', $params);
    }
    public function terms()
    {
        //dd('here1');
        $params = [];

        return view('frontend.terms', $params);
    }
    public function refund()
    {
        //dd('here1');
        $params = [];

        return view('frontend.refund', $params);
    }

    public function menu()
    {
        //dd('here1');
        $params = [];

        return view('frontend.menu', $params);
    }

    public function franchise()
    {
        //dd('here1');
        $params = [];

        return view('frontend.franchise', $params);
    }

    public function inquiry()
    {
        //dd('here1');
        $params = [];

        return view('frontend.inquiry', $params);
    }

    public function franchise_store(Request $request)
    {

        

    $request->validate([
        'name'                  => ['required', 'string', 'max:191'],
        'email'               => ['required', 'string', 'max:191'],
        'contact'       => ['required', 'string', 'max:191'],
    ]);
        $franchise                              = new Franchise;
        $franchise->name                        = $request->name;
        $franchise->email                       = $request->email;
        $franchise->contact                     = $request->contact;
        $franchise->address                     = $request->address;
        $franchise->academic                    = $request->academic;
        $franchise->profession                  = $request->profession;
        $franchise->location                    = $request->location;
   

        if (!$franchise->save()) {
            return back()->withInput()->with('fail', __('Franchise data creation request failed!'));
        }
        return view('frontend.success');
    }




}