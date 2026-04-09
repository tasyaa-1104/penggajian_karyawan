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
        try {
            Potongan::create($request->all());
            return redirect()->route('potongan.index')
                ->with('success', 'Potongan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambah potongan: ' . $e->getMessage());
        }
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
        try {
            Potongan::findOrFail($id)->update($request->all());
            return redirect()->route('potongan.index')
                ->with('success', 'Potongan berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal update potongan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = Potongan::destroy($id);
            if (!$deleted) {
                return redirect()->route('potongan.index')->with('error', 'Potongan tidak ditemukan atau gagal dihapus');
            }
            return redirect()->route('potongan.index')
                ->with('success', 'Potongan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('potongan.index')->with('error', 'Gagal menghapus potongan: ' . $e->getMessage());
        }
    }
}
