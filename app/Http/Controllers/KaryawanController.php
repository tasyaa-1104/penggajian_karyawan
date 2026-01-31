<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $karyawans = Karyawan::with(['divisi', 'jabatan'])
            ->when($search, function ($query) use ($search) {
                $query->where('nik', 'like', "%$search%")
                      ->orWhere('nama_karyawan', 'like', "%$search%")
                      ->orWhere('status_karyawan', 'like', "%$search%")
                      ->orWhereHas('divisi', fn ($q) =>
                          $q->where('nama_divisi', 'like', "%$search%"))
                      ->orWhereHas('jabatan', fn ($q) =>
                          $q->where('nama_jabatan', 'like', "%$search%"));
            })
            ->orderBy('nama_karyawan')
            ->get();

        return view('admin.karyawan', compact('karyawans', 'search'));
    }

    public function create()
    {
        return view('admin.karyawan-create', [
            'divisi'  => Divisi::all(),
            'jabatan' => Jabatan::all(),
        ]);
    }

   public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:karyawan,nik',
            'nama_karyawan' => 'required',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'status_karyawan' => 'required|in:aktif,nonaktif',
        ]);

        $jabatan = Jabatan::findOrFail($request->id_jabatan);

        Karyawan::create([
            'nik'             => $request->nik,
            'nama_karyawan'   => $request->nama_karyawan,
            'id_divisi'       => $request->id_divisi,
            'id_jabatan'      => $request->id_jabatan,
            'gaji_pokok'      => $jabatan->gaji_pokok, // ⬅️ AUTO DARI JABATAN
            'status_karyawan' => $request->status_karyawan,
        ]);

        return redirect()->route('karyawan')
            ->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin.karyawan-edit', [
            'karyawan' => Karyawan::findOrFail($id),
            'divisi'   => Divisi::all(),
            'jabatan'  => Jabatan::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|unique:karyawan,nik,' . $id . ',id_karyawan',
            'nama_karyawan' => 'required',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'gaji_pokok' => 'required|numeric|min:0',
            'status_karyawan' => 'required|in:aktif,nonaktif',
        ]);

        $karyawan = Karyawan::findOrFail($id);

        $karyawan->update([
            'nik'             => $request->nik,
            'nama_karyawan'   => $request->nama_karyawan,
            'id_divisi'       => $request->id_divisi,
            'id_jabatan'      => $request->id_jabatan,
            'gaji_pokok'      => $request->gaji_pokok, // ⬅️ NILAI REAL
            'status_karyawan' => $request->status_karyawan,
        ]);

        return redirect()->route('karyawan')
            ->with('success', 'Karyawan berhasil diupdate');
    }

    public function destroy($id)
    {
        Karyawan::destroy($id);

        return redirect()->route('karyawan')
            ->with('success', 'Karyawan berhasil dihapus');
    }
}
