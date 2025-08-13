<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
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
    public function index()
    {
        $roles = Role::latest()->get();
        $params = [
            'roles' => $roles
        ];
        return view('dashboard.role.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.role.create');
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
            'name' => ['required', 'string', 'max:255'],
        ]);
        $role = new Role;
        $role->name = $request->name;

        if (!$role->save()) {
            return back()->withInput()->with('fail', __('Role creation request failed!'));
        }
        return back()->with('success', __('Role added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Role  $role
     * @return Response
     */
    public function show(Role $role)
    {
        $params = [
            'role' => $role
        ];
        return view('dashboard.role.show', $params);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function permission(Role $role)
    {
        $params = [
            'role'          => $role,
            'permissions'   => json_decode($role->permissions, true) ?? [],
        ];
        return view('dashboard.role.permission', $params);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function permissionUpdate(Role $role, Request $request)
    {
        $request->validate([
            'permissions' => ['required'],
        ]);

        $role->permissions = json_encode($request->permissions);

        if (!$role->save()) {
            return back()->withInput()->with('fail', __('Role permission update request failed!'));
        }
        return back()->with('success', __('Role permission updated successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return Response
     */
    public function edit(Role $role)
    {
        $params = [
            'role' => $role
        ];
        return view('dashboard.role.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Role  $role
     * @return Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
        ]);
        $role->name = $request->name;

        if (!$role->save()) {
            return back()->withInput()->with('fail', __('Role modification request failed!'));
        }
        return back()->with('success', __('Role modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role  $role
     * @return Response
     */
    public function destroy(Role $role)
    {
        if ($role->users->count() > 0) {
            return back()->withInput()->with('fail', __('Role removing denied! this role has existing users!'));
        }

        if (!$role->delete()) {
            return back()->withInput()->with('fail', __('Role removing request failed!'));
        }
        return back()->with('success', __('Role removed successfully'));
    }
}
