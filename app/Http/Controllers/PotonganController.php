<?php

namespace App\Http\Controllers;

use App\Models\Potongan;
use Illuminate\Http\Request;

class PotonganController extends Controller
{
    public function index()
    {
        $potongan = Potongan::orderBy('nama_potongan')->get();
        return view('admin.potongan', compact('potongan'));
    }

    public function create()
    {
        return view('admin.potongan-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_potongan' => 'required',
            'nominal' => 'required|numeric|min:0'
        ]);

        Potongan::create($request->all());

        return redirect()->route('potongan.index')
            ->with('success', 'Potongan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $potongan = Potongan::findOrFail($id);
        return view('admin.potongan-edit', compact('potongan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_potongan' => 'required',
            'nominal' => 'required|numeric|min:0'
        ]);

        Potongan::findOrFail($id)->update($request->all());

        return redirect()->route('potongan.index')
            ->with('success', 'Potongan berhasil diupdate');
    }

    public function destroy($id)
    {
        Potongan::destroy($id);

        return redirect()->route('potongan.index')
            ->with('success', 'Potongan berhasil dihapus');
    }
}
