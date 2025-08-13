<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
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
        $coupons = new Coupon;
        if ($user->branch_id) {
            $coupons = $coupons->where('branch_id', $user->branch_id);
        } else if ($request->branch) {
            $coupons = $coupons->where('branch_id', $request->branch);
        }
        $coupons = $coupons->latest()->get();
        $params = [
            'coupons'   => $coupons,
            'branches'  => Branch::all(),
            'filter'    => [
                'date'      => $request->date,
                'branch'    => $request->branch,
            ],
        ];
        return view('dashboard.coupon.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $params = [
            'branches'  => Branch::all()
        ];
        return view('dashboard.coupon.create', $params);
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
            'branch_id'     => ['required', 'string', 'max:191'],
            'code'          => ['required', 'string', 'max:191'],
            'discount'      => ['required', 'string', 'max:191'],
            'days'          => ['nullable', 'max:191'],
            'end_date'      => ['nullable', 'string', 'max:191'],
            'start_date'    => ['nullable', 'string', 'max:191'],
        ]);

        $coupon             = new Coupon;
        $coupon->branch_id  = $request->branch_id;
        $coupon->code       = $request->code;
        $coupon->discount   = $request->discount;
        $coupon->days       = json_encode($request->days);
        $coupon->end_date   = $request->end_date;
        $coupon->start_date = $request->start_date;
        if (!$coupon->save()) {
            return back()->withInput()->with('fail', __('Coupon creation request failed!'));
        }
        return back()->with('success', __('Coupon added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Coupon  $coupon
     * @return Response
     */
    public function show(Coupon $coupon)
    {
        $params = [
            'coupon' => $coupon
        ];
        return view('dashboard.coupon.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Coupon  $coupon
     * @return Response
     */
    public function edit(Coupon $coupon)
    {
        $coupon->days = json_decode($coupon->days, true) ?? [];
        $params = [
            'coupon'    => $coupon,
            'branches'  => Branch::all()
        ];
        return view('dashboard.coupon.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Coupon  $coupon
     * @return Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'branch_id'     => ['required', 'string', 'max:191'],
            'code'          => ['required', 'string', 'max:191'],
            'discount'      => ['required', 'string', 'max:191'],
            'days'          => ['nullable', 'max:191'],
            'end_date'      => ['nullable', 'string', 'max:191'],
            'start_date'    => ['nullable', 'string', 'max:191'],
        ]);

        $coupon->branch_id  = $request->branch_id;
        $coupon->code       = $request->code;
        $coupon->discount   = $request->discount;
        $coupon->days       = json_encode($request->days);
        $coupon->end_date   = $request->end_date;
        $coupon->start_date = $request->start_date;

        if (!$coupon->save()) {
            return back()->withInput()->with('fail', __('Coupon modification request failed!'));
        }
        return back()->with('success', __('Coupon modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Coupon  $coupon
     * @return Response
     */
    public function destroy(Coupon $coupon)
    {
        if (!$coupon->delete()) {
            return back()->withInput()->with('fail', __('Coupon removing request failed!'));
        }
        return back()->with('success', __('Coupon removed successfully'));
    }
}
