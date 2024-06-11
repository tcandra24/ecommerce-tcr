<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('admin.roles.index', [ 'roles' => $roles ]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required'
        ]);

        try {
            $role = Role::create(['name' => $request->name]);

            $role->givePermissionTo($request->permissions);

            return redirect()->to('/admin/roles');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

    public function edit($id)
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);

            $permissions = Permission::all();
            return view('admin.roles.edit', [
                'role' => $role,
                'permissions' => $permissions
            ]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name'          => 'required',
            'permissions'   => 'required'
        ]);

        try {
            $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permissions);

            return redirect()->to('/admin/roles');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->to('/admin/roles');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
