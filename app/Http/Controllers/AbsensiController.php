<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
            'jam_masuk' => Carbon::now('Asia/Jakarta')->format('H:i'),
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


public function createKaryawan()
{
    $userId = session('user.id');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Silakan login dulu');
    }

    $karyawan = Karyawan::where('id_user', $userId)->first();

    if (!$karyawan) {
        return back()->with('error', 'Akun belum terhubung dengan data karyawan');
    }

    $absensiHariIni = Absensi::where('id_karyawan', $karyawan->id_karyawan)
        ->where('tanggal', Carbon::now('Asia/Jakarta')->toDateString())
        ->first();

    return view('admin.karyawan-absensi-create', compact(
        'karyawan',
        'absensiHariIni'
    ));
}


public function storeKaryawan(Request $request)
{
    $request->validate([
        'id_karyawan' => 'required',
        'tanggal' => 'required|date',
        'status_kehadiran' => 'required|in:Hadir,Izin,Alpha',
        'keterangan' => 'nullable'
    ]);

    // ⬇️ MASUK KE TABEL ABSENSI (ADMIN JUGA LIAT INI)
    Absensi::create([
        'id_karyawan' => $request->id_karyawan,
        'tanggal' => $request->tanggal,
        'jam_masuk' => Carbon::now('Asia/Jakarta')->format('H:i'),
        'status_kehadiran' => $request->status_kehadiran,
        'keterangan' => $request->keterangan
    ]);

    return redirect()->route('karyawan.dashboard')
        ->with('success', 'Absensi berhasil');
}
public function absenMasuk()
{
    $userId = session('user.id');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Silakan login dulu');
    }

    $karyawan = Karyawan::where('id_user', $userId)->first();

    if (!$karyawan) {
        return back()->with('error', 'Akun belum terhubung dengan data karyawan');
    }

    $tanggal = Carbon::now('Asia/Jakarta')->toDateString();

    $cek = Absensi::where('id_karyawan', $karyawan->id_karyawan)
        ->where('tanggal', $tanggal)
        ->first();

    if ($cek) {
        return back()->with('error', 'Kamu sudah absen masuk hari ini');
    }

    Absensi::create([
        'id_karyawan'      => $karyawan->id_karyawan,
        'tanggal'          => $tanggal,
        'jam_masuk'        => Carbon::now('Asia/Jakarta')->format('H:i:s'),
        'status_kehadiran' => 'Hadir',
    ]);

    return back()->with('success', 'Absen masuk berhasil');
}
public function absenPulang()
{
    $userId = session('user.id');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Silakan login dulu');
    }

    $karyawan = Karyawan::where('id_user', $userId)->first();

    if (!$karyawan) {
        return back()->with('error', 'Akun belum terhubung dengan data karyawan');
    }

    $tanggal = Carbon::now('Asia/Jakarta')->toDateString();

    $absensi = Absensi::where('id_karyawan', $karyawan->id_karyawan)
        ->where('tanggal', $tanggal)
        ->first();

    if (!$absensi) {
        return back()->with('error', 'Kamu belum absen masuk');
    }

    if ($absensi->jam_pulang) {
        return back()->with('error', 'Kamu sudah absen pulang');
    }

    $absensi->update([
        'jam_pulang' => Carbon::now('Asia/Jakarta')->format('H:i:s')
    ]);

    return back()->with('success', 'Absen pulang berhasil');
}

    // public function halamanAbsensi()
    // {
    //     // 1. Ambil user login
    //     $user = Auth::user();

    //     if (!$user) {
    //         abort(403, 'Belum login');
    //     }

    //     // 2. Ambil data karyawan berdasarkan user
    //     $karyawan = Karyawan::where('id_user', $user->id)->first();

    //     if (!$karyawan) {
    //         abort(403, 'Akun belum terhubung dengan karyawan');
    //     }

    //     // 3. Ambil absensi hari ini
    //     $absensiHariIni = Absensi::where('id_karyawan', $karyawan->id_karyawan)
    //         ->where('tanggal', Carbon::now('Asia/Jakarta')->toDateString())
    //         ->first();

    //     // 4. KIRIM KE BLADE (INI YANG KAMU TANYA)
    //     return view('karyawan.absensi', [
    //         'karyawan' => $karyawan,
    //         'absensiHariIni' => $absensiHariIni
    //     ]);
    // }


// public function absenMasuk()
// {
//     $user = auth()->user();

//     if (!$user || !$user->karyawan) {
//         return back()->with('error', 'Akun belum terhubung dengan data karyawan');
//     }

//     $id_karyawan = $user->karyawan->id_karyawan;
//     $tanggal = now()->toDateString();

//     $cek = Absensi::where('id_karyawan', $id_karyawan)
//         ->where('tanggal', $tanggal)
//         ->first();

//     if ($cek) {
//         return back()->with('error', 'Kamu sudah absen masuk hari ini');
//     }

//     Absensi::create([
//         'id_karyawan' => $id_karyawan,
//         'tanggal' => $tanggal,
//         'jam_masuk' => now()->timezone('Asia/Jakarta')->format('H:i:s'),
//         'status_kehadiran' => 'Hadir',
//     ]);

//     return back()->with('success', 'Absen masuk berhasil');
// }

// public function absenPulang()
// {
//     $user = auth()->user();

//     if (!$user || !$user->karyawan) {
//         return back()->with('error', 'Akun belum terhubung dengan data karyawan');
//     }

//     $id_karyawan = $user->karyawan->id_karyawan;
//     $tanggal = now()->toDateString();

//     $absensi = Absensi::where('id_karyawan', $id_karyawan)
//         ->where('tanggal', $tanggal)
//         ->first();

//     if (!$absensi) {
//         return back()->with('error', 'Belum absen masuk');
//     }

//     if ($absensi->jam_pulang) {
//         return back()->with('error', 'Kamu sudah absen pulang');
//     }

//     $absensi->update([
//         'jam_pulang' => now()->timezone('Asia/Jakarta')->format('H:i:s')
//     ]);

//     return back()->with('success', 'Absen pulang berhasil');
// }

}
