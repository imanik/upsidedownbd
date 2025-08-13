<?php

namespace App\Http\Controllers;

use App\Models\Franchise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FranchiseController extends Controller
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
      //  dd('here');

      $franchisers = Franchise::latest()->get();

    //    dd($franchises);
        
        $params = [
        
            'franchisers' => $franchisers,
          
        

        ];
        return view('dashboard.franchiser.index', $params);
    }



    public function destroy(Franchise $franchise)
    {
        if (!$franchise->delete()) {
            return back()->withInput()->with('fail', __('Franchiser removing request failed!'));
        }
        return back()->with('success', __('Franchiser removed successfully'));
    }

    

}
