<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolePermissionDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:access management index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(RolePermissionDataTable $dataTable): View | JsonResponse
    {
        return $dataTable->render('admin.role-permission.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $permissions  = Permission::all()->groupBy('group_name');
        return view('admin.role-permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role_name' => ['required', 'max:40', 'unique:roles,name'],
            'permissions' => ['required', 'array'],
        ]);

        $role = Role::create(['name' => $request->role_name]);

        $role->syncPermissions($request->permissions);

        return to_route('admin.role.index')->with('success', 'Role created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions  = Permission::all()->groupBy('group_name');
        return view('admin.role-permission.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'role_name' => ['required', 'max:40', 'unique:roles,name,' . $id],
            'permissions' => ['required', 'array'],
        ]);

        $role = Role::findOrFail($id);
        if ($role->name === 'Super Admin') {
            return to_route('admin.role.index')->with('error', 'You cannot update Super Admin role');
        }
        $role->update(['name' => $request->role_name]);


        $role->syncPermissions($request->permissions);

        return to_route('admin.role.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role =  Role::findOrFail($id);
            if ($role->name === 'Super Admin') {
                return response()->json(['status' => 'error', 'message' => 'You cannot delete Super Admin role']);
            }
            $role->delete();
            return response()->json(['status' => 'success', 'message' => 'Amenity deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
