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
        Tunjangan::create($request->all());
        return redirect()->route('tunjangan.index')->with('success','Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $tunjangan = Tunjangan::findOrFail($id);
        return view('finance.tunjangan-edit', compact('tunjangan'));
    }

    public function update(Request $request, $id)
    {
        Tunjangan::findOrFail($id)->update($request->all());
        return redirect()->route('tunjangan.index')->with('success','Data Berhasil Di Update');
    }

    public function destroy($id)
    {
        Tunjangan::destroy($id);
        return redirect()->route('tunjangan.index')->with('success','Data Berhasil Di Hapus');
    }
}
