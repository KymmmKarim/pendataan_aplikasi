<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with('parent')->orderBy('urut')->get();
        return view('units.index', compact('units'));
    }

    public function create()
    {
        $parents = Unit::orderBy('nama')->get();
        return view('units.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no' => 'required|unique:units,no',
            'nama' => 'required|string',
            'singkatan' => 'required|string|max:10',
            'urut' => 'nullable|integer',
            'parent_id' => 'nullable|exists:units,id',
            'aktif' => 'required|boolean',
        ]);

        Unit::create($request->all());

        return redirect()->route('units.index')->with('success', 'Unit berhasil ditambahkan.');
    }

    public function edit(Unit $unit)
    {
        $parents = Unit::where('id', '!=', $unit->id)->orderBy('nama')->get();
        return view('units.edit', compact('unit', 'parents'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'no' => 'required|unique:units,no,' . $unit->id,
            'nama' => 'required|string',
            'singkatan' => 'required|string|max:10',
            'urut' => 'nullable|integer',
            'parent_id' => 'nullable|exists:units,id',
            'aktif' => 'required|boolean',
        ]);

        $unit->update($request->all());

        return redirect()->route('units.index')->with('success', 'Unit berhasil diperbarui.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Unit berhasil dihapus.');
    }
}
