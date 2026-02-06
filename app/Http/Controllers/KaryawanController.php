<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $karyawans = Karyawan::with(['divisi','jabatan','user'])
            ->when($search, function ($q) use ($search) {
                $q->where('nik', 'like', "%$search%")
                  ->orWhereHas('user', fn ($u) =>
                        $u->where('nama', 'like', "%$search%"));
            })
            ->orderBy('id_karyawan','desc')
            ->get();

        return view('admin.karyawan', compact('karyawans','search'));
    }

    public function create()
    {
        return view('admin.karyawan-create', [
            'divisi'  => Divisi::all(),
            'jabatan' => Jabatan::all(),
            'users'   => User::where('role','karyawan')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user'   => 'required|exists:users,id',
            'nik'       => 'required|unique:karyawan,nik',
            'id_divisi' => 'required',
            'id_jabatan'=> 'required',
            'status_karyawan' => 'required',
        ]);

        $user    = User::findOrFail($request->id_user);
        $jabatan = Jabatan::findOrFail($request->id_jabatan);

        Karyawan::create([
            'id_user'         => $user->id,
            'nik'             => $request->nik,
            'nama_karyawan'   => $user->nama,
            'id_divisi'       => $request->id_divisi,
            'id_jabatan'      => $request->id_jabatan,
            'gaji_pokok'      => $jabatan->gaji_pokok,
            'status_karyawan' => $request->status_karyawan,
        ]);

        return redirect()->route('karyawan')
            ->with('success','Karyawan berhasil ditambahkan');
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
            'id_user'   => 'required|exists:users,id',
            'nik'       => 'required|unique:karyawan,nik,' . $id . ',id_karyawan',
            'id_divisi' => 'required',
            'id_jabatan'=> 'required',
            'gaji_pokok'=> 'required|numeric',
            'status_karyawan' => 'required',
        ]);

        $user = User::findOrFail($request->id_user);

        Karyawan::where('id_karyawan',$id)->update([
            'id_user'         => $user->id,
            'nik'             => $request->nik,
            'nama_karyawan'   => $user->nama,
            'id_divisi'       => $request->id_divisi,
            'id_jabatan'      => $request->id_jabatan,
            'gaji_pokok'      => $request->gaji_pokok,
            'status_karyawan' => $request->status_karyawan,
        ]);

        return redirect()->route('karyawan')
            ->with('success','Karyawan berhasil diupdate');
    }

    public function destroy($id)
    {
        Karyawan::where('id_karyawan',$id)->delete();

        return redirect()->route('karyawan')
            ->with('success','Karyawan berhasil dihapus');
    }

     public function dashboardKaryawan()
    {
        $userId = session('user.id');

        $karyawan = Karyawan::with(['jabatan','divisi'])
            ->where('id_user', $userId)
            ->firstOrFail();

        // --- LOGIKA HITUNG DATA ABSENSI ---
        $totalHadir = Absensi::where('id_karyawan', $karyawan->id_karyawan)
                            ->where('status_kehadiran', 'Hadir')
                            ->count();

        // Gabungkan Izin dan Sakit menjadi satu kategori "Izin"
        $totalIzin = Absensi::where('id_karyawan', $karyawan->id_karyawan)
                           ->whereIn('status_kehadiran', ['Izin', 'Sakit'])
                           ->count();

        $totalAlpha = Absensi::where('id_karyawan', $karyawan->id_karyawan)
                            ->where('status_kehadiran', 'Alpha')
                            ->count();

        return view('karyawan-dashboard', compact(
            'karyawan',
            'totalHadir',
            'totalIzin',
            'totalAlpha'
        ));
    }
}
