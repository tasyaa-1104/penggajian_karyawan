<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $divisi = Divisi::when($search, function ($query, $search) {
                $query->where('nama_divisi', 'like', "%{$search}%");
            })
            ->orderBy('nama_divisi')
            ->get();

        return view('admin.divisi', compact('divisi', 'search'));
    }

    public function create()
    {
        return view('admin.divisi-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required|string|max:255',
        ]);

        Divisi::create([
            'nama_divisi' => $request->nama_divisi,
        ]);

        return redirect()->route('divisi.index')
            ->with('success', 'Divisi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $divisi = Divisi::where('id_divisi', $id)->first();
        return view('admin.divisi-edit', compact('divisi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_divisi' => 'required|string|max:255',
        ]);

        Divisi::where('id_divisi', $id)->update([
            'nama_divisi' => $request->nama_divisi,
        ]);

        return redirect()->route('divisi.index')
            ->with('success', 'Divisi berhasil diupdate');
    }

    public function destroy($id)
    {
        Divisi::where('id_divisi', $id)->delete();

        return redirect()->route('divisi.index')
            ->with('success', 'Divisi berhasil dihapus');
    }
}
