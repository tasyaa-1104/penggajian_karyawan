<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;

class AbsensiController extends Controller
{
    // TAMPILKAN DATA + SEARCH
    public function index(Request $request)
    {
        $search = $request->search;

        $absensi = Absensi::with('karyawan')
            ->when($search, function ($query, $search) {
                $query->whereHas('karyawan', function ($q) use ($search) {
                        $q->where('nama_karyawan', 'like', "%{$search}%");
                    })
                    ->orWhere('tanggal', 'like', "%{$search}%")
                    ->orWhere('status_kehadiran', 'like', "%{$search}%");
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.absensi', [
            'absensi' => $absensi,
            'search'  => $search
        ]);
    }

    public function create()
    {
        return view('admin.absensi-create', [
            'karyawan' => Karyawan::all()
        ]);
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required|in:Hadir,Izin,Alpha',
            'keterangan' => 'nullable'
        ]);

        Absensi::create([
            'id_karyawan' => $request->id_karyawan,
            'tanggal' => $request->tanggal,
            'status_kehadiran' => $request->status_kehadiran,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('absensi')
            ->with('success', 'Absensi berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin.absensi-edit', [
            'absensi'  => Absensi::findOrFail($id),
            'karyawan' => Karyawan::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required|in:Hadir,Izin,Alpha',
            'keterangan' => 'nullable'
        ]);

        Absensi::findOrFail($id)->update([
            'id_karyawan' => $request->id_karyawan,
            'tanggal' => $request->tanggal,
            'status_kehadiran' => $request->status_kehadiran,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('absensi')
            ->with('success', 'Absensi berhasil diupdate');
    }

    public function destroy($id)
    {
        Absensi::where('id_absensi', $id)->delete();

        return redirect()->route('absensi')
            ->with('success', 'Data absensi berhasil dihapus');
    }
}
