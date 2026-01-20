<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Divisi;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
   public function index()
{
    $jabatan = Jabatan::with('divisi')->orderBy('nama_jabatan')->get();
    return view('admin.jabatan', compact('jabatan'));
}
    public function create()
    {
        $divisi = Divisi::orderBy('nama_divisi')->get();
       return view('admin.jabatan-create', compact('divisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric',
            'id_divisi' => 'required|exists:divisi,id_divisi',
        ]);

        Jabatan::create($request->all());

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $divisi = Divisi::orderBy('nama_divisi')->get();
        return view('admin.jabatan-edit', compact('jabatan', 'divisi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric',
            'id_divisi' => 'required|exists:divisi,id_divisi',
        ]);

        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update($request->all());

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil diupdate');
    }

    public function destroy($id)
    {
        Jabatan::destroy($id);

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil dihapus');
    }
}
