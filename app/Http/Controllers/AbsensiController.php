<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;

class AbsensiController extends Controller
{
    // TAMPILKAN DATA
    public function index()
    {
        return view('admin.absensi', [
            'karyawan' => Karyawan::all(),
            'absensi'  => Absensi::with('karyawan')
                            ->orderBy('tanggal', 'desc')
                            ->get()
        ]);
    }
     public function create()
    {
        return view('admin.absensi-create', [
            'karyawan' => Karyawan::all()
        ]);
    }

    // SIMPAN DATA (TAMBAH)
public function store(Request $request)
{
    $request->validate([
        'id_karyawan' => 'required',
        'tanggal' => 'required|date',
        'status_kehadiran' => 'required',
        'keterangan' => 'nullable'
    ]);

    Absensi::create([
        'id_karyawan' => $request->id_karyawan,
        'tanggal' => $request->tanggal,
        'status_kehadiran' => $request->status_kehadiran,
        'keterangan' => $request->keterangan
    ]);

    return redirect()->route('absensi')->with('success', 'Absensi berhasil ditambahkan');
}

    // FORM EDIT
    public function edit($id)
    {
        return view('admin.absensi.edit', [
            'absensi'  => Absensi::findOrFail($id),
            'karyawan' => Karyawan::all()
        ]);
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required',
            'keterangan' => 'nullable'
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update([
            'id_karyawan' => $request->id_karyawan,
            'tanggal' => $request->tanggal,
            'status_kehadiran' => $request->status_kehadiran,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('absensi')
                         ->with('success', 'Absensi berhasil diupdate');
    }

    // HAPUS DATA
public function destroy($id)
{
    Absensi::where('id_absensi', $id)->delete();

    return redirect()->route('absensi')
        ->with('success', 'Data absensi berhasil dihapus');
}

}
