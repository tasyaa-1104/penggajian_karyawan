<?php

namespace App\Http\Controllers;

use App\Models\Tunjangan;
use Illuminate\Http\Request;

class TunjanganController extends Controller
{
    public function index()
    {
        $tunjangan = Tunjangan::all();
        return view('finance.tunjangan', compact('tunjangan'));
    }

    public function create()
    {
        return view('finance.tunjangan-create');
    }

    public function store(Request $request)
    {
        try {
            Tunjangan::create($request->all());
            return redirect()->route('tunjangan.index')->with('success','Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambah tunjangan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $tunjangan = Tunjangan::findOrFail($id);
        return view('finance.tunjangan-edit', compact('tunjangan'));
    }

    public function update(Request $request, $id)
    {
        try {
            Tunjangan::findOrFail($id)->update($request->all());
            return redirect()->route('tunjangan.index')->with('success','Data Berhasil Di Update');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal update tunjangan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = Tunjangan::destroy($id);
            if (!$deleted) {
                return redirect()->route('tunjangan.index')->with('error', 'Tunjangan tidak ditemukan atau gagal dihapus');
            }
            return redirect()->route('tunjangan.index')->with('success','Data Berhasil Di Hapus');
        } catch (\Exception $e) {
            return redirect()->route('tunjangan.index')->with('error', 'Gagal menghapus tunjangan: ' . $e->getMessage());
        }
    }
}
