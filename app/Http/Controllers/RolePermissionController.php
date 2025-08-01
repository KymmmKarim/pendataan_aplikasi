<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::with('permissions')->get();
            $permissions = Permission::all();
            return view('roles.index', compact('roles', 'permissions'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $permissions = Permission::all();
            return view('roles.create', compact('permissions'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
            ]);

            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Role dan Permission berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function ajaxStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first('name'),
            ], 422);
        }

        DB::beginTransaction();
        try {
            $permission = Permission::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'permission' => $permission,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan permission: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroyPermissionAjax($id)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Permission berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus permission: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $role = Role::findOrFail($id);
            $permissions = Permission::all();
            return view('roles.edit', compact('role', 'permissions'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'guard_name' => 'required',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);

            $role->update([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
            ]);

            $role->syncPermissions($request->permissions ?? []);

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Role & Permission berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus role: ' . $e->getMessage());
        }
    }

    public function createPermission()
    {
        return view('roles.create-permission');
    }

    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'required'
        ]);

        DB::beginTransaction();
        try {
            Permission::create($request->only('name', 'guard_name'));

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Permission berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan permission: ' . $e->getMessage());
        }
    }

    public function editPermission($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            return view('roles.edit-permission', compact('permission'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat data permission: ' . $e->getMessage());
        }
    }

    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
            'guard_name' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $permission = Permission::findOrFail($id);
            $permission->update($request->only('name', 'guard_name'));

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Permission berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal update permission: ' . $e->getMessage());
        }
    }

    public function destroyPermission($id)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            DB::commit();
            return response()->json(['message' => 'Permission deleted']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal menghapus: ' . $e->getMessage()], 500);
        }
    }

    public function managePermissions($roleId)
    {
        try {
            $role = Role::findOrFail($roleId);
            $permissions = Permission::all();
            $rolePermissions = $role->permissions->pluck('id')->toArray();

            return view('roles.manage-permissions', compact('role', 'permissions', 'rolePermissions'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memuat data role/permission: ' . $e->getMessage());
        }
    }

    public function updatePermissions(Request $request, $roleId)
    {
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($roleId);
            $role->syncPermissions($request->permissions ?? []);

            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Permission berhasil diperbarui untuk role.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update permission role: ' . $e->getMessage());
        }
    }
}
