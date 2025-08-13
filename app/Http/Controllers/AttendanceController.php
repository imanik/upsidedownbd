<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
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
        $attendances = new Attendance;
        if ($user->branch_id) {
            $attendances = $attendances->where('branch_id', $user->branch_id);
        } else if ($request->branch) {
            $attendances = $attendances->where('branch_id', $request->branch);
        }
        if ($request->date) {
            $attendances = $attendances->where('date', $request->date);
        }
        if ($request->employee) {
            $attendances = $attendances->where('employee_id', $request->employee);
        }
        $attendances = $attendances->latest()->get();
        $params = [
            'attendances'   => $attendances,
            'branches'      => Branch::all(),
            'employees'     => Employee::where('status', 'active')->get(),
            'attendance'    => [],
            'permissions'   => [],
            'filter'        => [
                'date'      => $request->date,
                'branch'    => $request->branch,
                'employee'  => $request->employee,
            ]
        ];
        return view('dashboard.attendance.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $date = date('Y-m-d');
        $type = $request->type == 'check-out' ? $request->type : 'check-in';
        $branches = new Branch;
        if ($user->branch_id) {
            $branches = $branches->where('id', $user->branch_id);
        }
        $branches = $branches->latest()->get();
        foreach ($branches as $branch) {
            if ($type == 'check-out') {
                $attendances = Attendance::whereNull('check_out')->where('date', $date)->where('branch_id', $branch->id)->get();
                $employees  = [];
                foreach ($attendances as $attendance) {
                    $employees[] = Employee::find($attendance->employee_id);
                }
            } else {
                $employees  = $branch->employees;
            }
            $branch->employees  = $employees;
        }

        $params = [
            'type'      => $type,
            'date'      => $date,
            'branches'  => $branches,
        ];
        return view('dashboard.attendance.create', $params);
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
            'date'      => ['required', 'string', 'max:255'],
            'time'      => ['required', 'string', 'max:255'],
            'type'      => ['required', 'string', 'max:255'],
            'group_attendances' => ['required', 'array', 'max:255'],
        ]);
        DB::beginTransaction();
        foreach ($request->group_attendances as $branch => $employees) {

            $date   = $request->date;
            $time   = $request->time;
            $branch = Branch::where('name', $branch)->first();
            foreach ($employees as $employee_id => $status) {
                if ($request->type == 'check-in') {
                    $attendance = Attendance::create([
                        'date'          => $date,
                        'check_in'      => $time,
                        'branch_id'     => $branch->id,
                        'employee_id'   => $employee_id,
                    ]);
                } else {
                    $attendance = Attendance::where('date', $date)->where('branch_id', $branch->id)->where('employee_id', $employee_id)->first();
                    $attendance->update(['check_out' => $time]);
                }
                if (!$attendance) {
                    DB::rollback();
                    return back()->withInput()->with('fail', __('Attendance Failed!!!'));
                }
            }
        }
        DB::commit();
        return back()->with('success', __('Attendance added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Attendance  $attendance
     * @return Response
     */
    public function show(Attendance $attendance)
    {
        $params = [
            'attendance' => $attendance
        ];
        return view('dashboard.attendance.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Attendance  $attendance
     * @return Response
     */
    public function edit(Attendance $attendance)
    {
        $params = [
            'attendance' => $attendance
        ];
        return view('dashboard.attendance.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Attendance  $attendance
     * @return Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'date'      => ['required', 'string', 'max:255'],
            'check_in'  => ['required', 'string', 'max:255'],
            'check_out' => ['required', 'string', 'max:255'],
        ]);
        $attendance->date       = $request->date;
        $attendance->check_in   = $request->check_in;
        $attendance->check_out  = $request->check_out;

        if (!$attendance->save()) {
            return back()->withInput()->with('fail', __('Attendance modification request failed!'));
        }
        return back()->with('success', __('Attendance modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Attendance  $attendance
     * @return Response
     */
    public function destroy(Attendance $attendance)
    {
        if ($attendance->users->count() > 0) {
            return back()->withInput()->with('fail', __('Attendance removing denied! this attendance has existing users!'));
        }

        if (!$attendance->delete()) {
            return back()->withInput()->with('fail', __('Attendance removing request failed!'));
        }
        return back()->with('success', __('Attendance removed successfully'));
    }
}
