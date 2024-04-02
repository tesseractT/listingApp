<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleUserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleUserCreateRequest;
use App\Http\Requests\Admin\RoleUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:access management index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(RoleUserDataTable $dataTable): View | JsonResponse
    {
        return $dataTable->render('admin.role-permission.role-user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('admin.role-permission.role-user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleUserCreateRequest $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = 'admin';
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole($request->role);

        return redirect()->route('admin.role-user.index')->with('success', 'User created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::all();

        $users = User::findOrFail($id);

        return view('admin.role-permission.role-user.edit', compact('roles', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUserUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($user->hasRole('Super Admin')) {
            return redirect()->route('admin.role-user.index')->with('error', 'You can not update super admin');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = 'admin';
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.role-user.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->hasRole('Super Admin')) {
                return response()->json(['status' => 'error', 'message' => 'You can not delete super admin']);
            }
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'Amenity deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
