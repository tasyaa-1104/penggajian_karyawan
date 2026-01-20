<?php

namespace App\Http\Controllers;

use App\Models\slip_gaji;
use App\Models\gaji;
use Illuminate\Http\Request;

class slip_gajicontroller extends Controller
{
    public function index()
    {
        $slip_gaji = slip_gaji::with('gaji.karyawan')->get();
        return view('admin.slip-gaji', compact('slip_gaji'));
    }

    public function create()
    {
        $gaji = gaji::with('karyawan')->get();
        return view('admin.slip-gaji-create', compact('gaji'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_gaji' => 'required',
            'tanggal_cetak' => 'required|date',
        ]);

        slip_gaji::create([
            'id_gaji' => $request->id_gaji,
            'tanggal_cetak' => $request->tanggal_cetak,
            'file_slip' => $request->file_slip
        ]);

        return redirect()->route('slip-gaji.index')
            ->with('success', 'slip gaji berhasil dibuat');
    }

    public function edit($id)
    {
        $slip_gaji = slip_gaji::findOrFail($id);
        $gaji = gaji::with('karyawan')->get();

        return view('admin.slip-gaji-edit', compact('slip_gaji', 'gaji'));
    }

    public function update(Request $request, $id)
    {
        slip_gaji::findOrFail($id)->update($request->all());

        return redirect()->route('slip-gaji.index')
            ->with('success', 'slip gaji berhasil diupdate');
    }

    public function destroy($id)
    {
        slip_gaji::destroy($id);

        return redirect()->route('slip-gaji.index')
            ->with('success', 'slip gaji berhasil dihapus');
    }
}
