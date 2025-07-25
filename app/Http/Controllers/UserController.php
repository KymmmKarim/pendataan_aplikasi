<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $units = Unit::all();
        return view('users.create', compact('roles', 'units'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|exists:roles,name',
        ];

        // Jika role adalah admin-unit, maka unit wajib diisi
        if ($request->role === 'admin-unit') {
            $rules['unit'] = 'required|exists:units,id';
        }

        $validated = $request->validate($rules);

        // Simpan user
        $user = User::create([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'unit_id'  => $request->role === 'admin-unit' ? $request->unit : null,
        ]);

        // Assign role
        $user->assignRole($validated['role']);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $units = Unit::all();
        return view('users.edit', compact('user', 'roles', 'units'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role'     => 'required|exists:roles,name',
        ];

        if ($request->role === 'admin-unit') {
            $rules['unit'] = 'required|exists:units,id';
        }

        $validated = $request->validate($rules);

        $user->update([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'password' => $validated['password']
                ? Hash::make($validated['password'])
                : $user->password,
            'unit_id'  => $request->role === 'admin-unit' ? $request->unit : null,
        ]);

        // Sync role baru
        $user->syncRoles([$validated['role']]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
