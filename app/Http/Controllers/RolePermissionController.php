<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    // Tampilkan daftar semua role dan permission
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('roles.index', compact('roles', 'permissions'));
    }

    // Form create role + permission
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    // Simpan role baru (dan optional permission)
   public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|unique:roles,name',
        'guard_name' => 'required',
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,name',
    ]);

    $role = Role::create([
        'name' => $request->name,
        'guard_name' => $request->guard_name,
    ]);

    // Assign permission jika dipilih
    if ($request->has('permissions')) {
        $role->syncPermissions($request->permissions);
    }

    return redirect()->route('roles.index')->with('success', 'Role dan Permission berhasil disimpan');
    }

    // Form edit role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    // Update role
    public function update(Request $request, $id)
{
    $role = Role::findOrFail($id);

    $request->validate([
        'name' => 'required|unique:roles,name,' . $id,
        'guard_name' => 'required',
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,name',
    ]);

    // Update nama & guard role
    $role->update([
        'name' => $request->name,
        'guard_name' => $request->guard_name,
    ]);

    // Sinkronisasi permission (replace dengan yang dicentang)
    $role->syncPermissions($request->permissions ?? []);

    return redirect()->route('roles.index')->with('success', 'Role & Permission berhasil diperbarui.');
}

    // Hapus role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus');
    }

    // =================== PERMISSION CRUD ===================

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

        Permission::create($request->only('name', 'guard_name'));

        return redirect()->route('roles.index')->with('success', 'Permission berhasil ditambahkan');
    }

    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('roles.edit-permission', compact('permission'));
    }

    public function updatePermission(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
            'guard_name' => 'required'
        ]);

        $permission->update($request->only('name', 'guard_name'));

        return redirect()->route('roles.index')->with('success', 'Permission berhasil diperbarui');
    }

    public function destroyPermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('roles.index')->with('success', 'Permission berhasil dihapus');
    }

    // =================== ASSIGN PERMISSION TO ROLE ===================

    public function managePermissions($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.manage-permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    public function updatePermissions(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Permission berhasil diperbarui untuk role.');
    }
}
