<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
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
        $employees = new Employee;
        if ($user->branch_id) {
            $employees = $employees->where('branch_id', $user->branch_id);
        } else if ($request->branch) {
            $employees = $employees->where('branch_id', $request->branch);
        }
        $employees = $employees->latest()->get();
        $params = [
            'employees' => $employees,
            'branches'  => Branch::all(),
            'filter'    => [
                'branch'    => $request->branch,
            ],
        ];
        return view('dashboard.employee.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $params = [
            'designations'  => Designation::all(),
            'branches'      => Branch::all()
        ];
        return view('dashboard.employee.create', $params);
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
            'address'       => ['nullable', 'string', 'max:191'],
            'branch'        => ['required', 'string', 'max:191'],
            'designation'   => ['required', 'string', 'max:191'],
            'name'          => ['required', 'string', 'max:191'],
            'mobile'        => ['nullable', 'string', 'max:191'],
        ]);

        $employee                   = new Employee;
        $employee->name             = $request->name;
        $employee->mobile           = $request->mobile;
        $employee->address          = $request->address;
        $employee->branch_id        = $request->branch;
        $employee->designation_id   = $request->designation;
        if (!$employee->save()) {
            return back()->withInput()->with('fail', __('Employee creation request failed!'));
        }
        return back()->with('success', __('Employee added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee  $employee
     * @return Response
     */
    public function show(Employee $employee)
    {
        $params = [
            'employee' => $employee
        ];
        return view('dashboard.employee.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Employee  $employee
     * @return Response
     */
    public function edit(Employee $employee)
    {
        $params = [
            'branches'      => Branch::all(),
            'designations'  => Designation::all(),
            'employee'      => $employee,
        ];
        return view('dashboard.employee.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Employee  $employee
     * @return Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'address'       => ['nullable', 'string', 'max:191'],
            'branch'        => ['required', 'string', 'max:191'],
            'designation'   => ['required', 'string', 'max:191'],
            'name'          => ['required', 'string', 'max:191'],
            'mobile'        => ['nullable', 'string', 'max:191'],
        ]);

        $employee->name             = $request->name;
        $employee->mobile           = $request->mobile;
        $employee->address          = $request->address;
        $employee->branch_id        = $request->branch;
        $employee->designation_id   = $request->designation;
        if (!$employee->save()) {
            return back()->withInput()->with('fail', __('Employee modification request failed!'));
        }
        return back()->with('success', __('Employee modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee  $employee
     * @return Response
     */
    public function destroy(Employee $employee)
    {
        if (!$employee->delete()) {
            return back()->withInput()->with('fail', __('Employee removing request failed!'));
        }
        return back()->with('success', __('Employee removed successfully'));
    }
}
