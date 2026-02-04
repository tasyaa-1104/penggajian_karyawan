<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $karyawans = Karyawan::with(['divisi', 'jabatan', 'user'])
            ->when($search, function ($query) use ($search) {
                $query->where('nik', 'like', "%$search%")
                    ->orWhereHas('user', fn ($q) =>
                        $q->where('nama', 'like', "%$search%"))
                    ->orWhereHas('divisi', fn ($q) =>
                        $q->where('nama_divisi', 'like', "%$search%"))
                    ->orWhereHas('jabatan', fn ($q) =>
                        $q->where('nama_jabatan', 'like', "%$search%"));
            })
            ->orderBy('id_karyawan', 'desc')
            ->get();

        return view('admin.karyawan', compact('karyawans', 'search'));
    }

    public function create()
    {
        return view('admin.karyawan-create', [
            'divisi'  => Divisi::all(),
            'jabatan' => Jabatan::all(),
            'users'   => User::where('role', 'karyawan')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user'   => 'required|exists:users,id',
            'nik'       => 'required|unique:karyawan,nik',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'id_jabatan'=> 'required|exists:jabatan,id_jabatan',
            'status_karyawan' => 'required|in:aktif,nonaktif',
        ]);

        $user    = User::findOrFail($request->id_user);
        $jabatan = Jabatan::findOrFail($request->id_jabatan);

        Karyawan::create([
            'id_user'         => $user->id,
            'nik'             => $request->nik,
            'nama_karyawan'   => $user->nama, // 🔥 AMBIL DARI USER
            'id_divisi'       => $request->id_divisi,
            'id_jabatan'      => $request->id_jabatan,
            'gaji_pokok'      => $jabatan->gaji_pokok,
            'status_karyawan' => $request->status_karyawan,
        ]);

        return redirect()->route('karyawan')
            ->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin.karyawan-edit', [
            'karyawan' => Karyawan::with('user')->findOrFail($id),
            'divisi'   => Divisi::all(),
            'jabatan'  => Jabatan::all(),
            'users'    => User::where('role', 'karyawan')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user'   => 'required|exists:users,id',
            'nik'       => 'required|unique:karyawan,nik,' . $id . ',id_karyawan',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'id_jabatan'=> 'required|exists:jabatan,id_jabatan',
            'gaji_pokok'=> 'required|numeric|min:0',
            'status_karyawan' => 'required|in:aktif,nonaktif',
        ]);

        $user = User::findOrFail($request->id_user);

        Karyawan::findOrFail($id)->update([
            'id_user'         => $user->id,
            'nik'             => $request->nik,
            'nama_karyawan'   => $user->nama, // 🔥 SYNC ULANG
            'id_divisi'       => $request->id_divisi,
            'id_jabatan'      => $request->id_jabatan,
            'gaji_pokok'      => $request->gaji_pokok,
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

   // Menampilkan dashboard karyawan (public tapi pakai login + role)
   // Tambahkan ini di paling atas file bersama use yang lain

// ... (kode lainnya tetap sama)

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
