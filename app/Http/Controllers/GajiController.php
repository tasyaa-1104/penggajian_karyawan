<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::with('karyawan')->get();
        return view('admin.gaji', compact('gaji'));
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        return view('admin.gaji-create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        Gaji::create([
            'id_karyawan' => $request->id_karyawan,
            'bulan' => $request->bulan,
            'total_tunjangan' => $request->total_tunjangan,
            'total_potongan' => $request->total_potongan,
            'gaji_bersih' => $request->gaji_bersih,
        ]);

        return redirect()->route('gaji.index')
            ->with('success','Data gaji berhasil disimpan');
    }

    public function edit($id)
    {
        $gaji = Gaji::findOrFail($id);
        $karyawan = Karyawan::all();
        return view('admin.gaji-edit', compact('gaji','karyawan'));
    }

    public function update(Request $request, $id)
    {
        Gaji::findOrFail($id)->update($request->all());
        return redirect()->route('gaji.index');
    }

    public function destroy($id)
    {
        Gaji::destroy($id);
        return redirect()->route('gaji.index');
    }
}
