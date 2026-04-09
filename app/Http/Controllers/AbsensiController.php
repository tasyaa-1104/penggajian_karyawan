<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use Carbon\Carbon;
use App\Models\Libur;
use App\Models\Izin;
use App\Models\Sakit;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
public function index(Request $request)
{
    $search = $request->search;

    // $absensi = Absensi::with('karyawan')
    //     ->when($search, function ($query) use ($search) {
    //         $query->where(function ($q) use ($search) {

    //             $q->whereHas('karyawan', function ($k) use ($search) {
    //                 $k->where('nama_karyawan', 'like', "%{$search}%");
    //             })
    //             ->orWhere('tanggal', 'like', "%{$search}%")
    //             ->orWhere('status_kehadiran', 'like', "%{$search}%")
    //             ->orWhereRaw("
    //                 CASE
    //                     WHEN MONTH(tanggal)=1 THEN 'Januari'
    //                     WHEN MONTH(tanggal)=2 THEN 'Februari'
    //                     WHEN MONTH(tanggal)=3 THEN 'Maret'
    //                     WHEN MONTH(tanggal)=4 THEN 'April'
    //                     WHEN MONTH(tanggal)=5 THEN 'Mei'
    //                     WHEN MONTH(tanggal)=6 THEN 'Juni'
    //                     WHEN MONTH(tanggal)=7 THEN 'Juli'
    //                     WHEN MONTH(tanggal)=8 THEN 'Agustus'
    //                     WHEN MONTH(tanggal)=9 THEN 'September'
    //                     WHEN MONTH(tanggal)=10 THEN 'Oktober'
    //                     WHEN MONTH(tanggal)=11 THEN 'November'
    //                     WHEN MONTH(tanggal)=12 THEN 'Desember'
    //                 END LIKE ?
    //             ", ["%{$search}%"]);
    //         });
    //     })
    //     ->orderBy('tanggal', 'desc')
    //     ->orderBy('jam_masuk', 'desc')
    //     ->orderBy('id_absensi', 'desc')
    //     ->get();
$absensi = Absensi::with('karyawan')
    ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {

            $q->whereHas('karyawan', function ($k) use ($search) {
                $k->where('nama_karyawan', 'like', "%{$search}%");
            })
            ->orWhere('tanggal', 'like', "%{$search}%")
            ->orWhere('status_kehadiran', 'like', "%{$search}%")
            ->orWhereRaw("
                CASE
                    WHEN MONTH(tanggal)=1 THEN 'Januari'
                    WHEN MONTH(tanggal)=2 THEN 'Februari'
                    WHEN MONTH(tanggal)=3 THEN 'Maret'
                    WHEN MONTH(tanggal)=4 THEN 'April'
                    WHEN MONTH(tanggal)=5 THEN 'Mei'
                    WHEN MONTH(tanggal)=6 THEN 'Juni'
                    WHEN MONTH(tanggal)=7 THEN 'Juli'
                    WHEN MONTH(tanggal)=8 THEN 'Agustus'
                    WHEN MONTH(tanggal)=9 THEN 'September'
                    WHEN MONTH(tanggal)=10 THEN 'Oktober'
                    WHEN MONTH(tanggal)=11 THEN 'November'
                    WHEN MONTH(tanggal)=12 THEN 'Desember'
                END LIKE ?
            ", ["%{$search}%"]);
        });
    })
    ->orderBy('tanggal', 'desc')
    ->orderBy('id_absensi', 'desc')
    ->get();

    return view('admin.absensi', [
        'absensi' => $absensi,
        'search' => $search,
        'karyawan' => Karyawan::all()
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
        try {
            Absensi::create([
                'id_karyawan' => $request->id_karyawan,
                'tanggal' => $request->tanggal,
                'jam_masuk' => Carbon::now('Asia/Jakarta')->format('H:i'),
                'status_kehadiran' => $request->status_kehadiran,
                'keterangan' => $request->keterangan
            ]);
            return redirect()->route('absensi')
                ->with('success', 'Absensi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambah absensi: ' . $e->getMessage());
        }
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
        try {
            Absensi::findOrFail($id)->update([
                'id_karyawan' => $request->id_karyawan,
                'tanggal' => $request->tanggal,
                'status_kehadiran' => $request->status_kehadiran,
                'keterangan' => $request->keterangan
            ]);
            return redirect()->route('absensi')
                ->with('success', 'Absensi berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal update absensi: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = Absensi::where('id_absensi', $id)->delete();
            if (!$deleted) {
                return redirect()->route('absensi')->with('error', 'Data absensi tidak ditemukan atau gagal dihapus');
            }
            return redirect()->route('absensi')
                ->with('success', 'Data absensi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('absensi')->with('error', 'Gagal menghapus absensi: ' . $e->getMessage());
        }
    }

public function createKaryawan()
{

    $karyawan = Karyawan::where('id_user', Auth::user()->id)->first();

    if (!$karyawan) {
        return back()
            ->with('error', 'Akun belum terhubung dengan data karyawan');
    }

    // 📅 TANGGAL HARI INI (WIB)
    $hariIni = Carbon::now('Asia/Jakarta')->toDateString();

    // 🔍 CEK ABSENSI HARI INI
    $absensiHariIni = Absensi::where('id_karyawan', $karyawan->id_karyawan)
        ->where('tanggal', $hariIni)
        ->first();
// 🔴 CEK APAKAH HARI INI LIBUR NASIONAL
$liburHariIni = Libur::whereDate('tanggal', $hariIni)->first();

$isLibur   = $liburHariIni ? true : false;
$namaLibur = $liburHariIni?->keterangan;

// ⬇️ LIST LIBUR UNTUK KALENDER
$liburList = Libur::get()->map(function ($l) {
    return [
        'tanggal' => $l->tanggal->format('Y-m-d'),
        'keterangan' => $l->keterangan
    ];
});


return view('karyawan-absensi-create', compact(
    'karyawan',
    'absensiHariIni',
    'isLibur',
    'namaLibur',
    'liburList'
));

}


public function storeKaryawan(Request $request)
{
    $request->validate([
        'id_karyawan' => 'required',
        'tanggal' => 'required|date',
        'status_kehadiran' => 'required|in:Hadir,Izin,Sakit,Alpha',
        'alasan' => 'nullable',
        'keterangan' => 'nullable'
    ]);

    $alasan = $request->alasan ?? $request->keterangan;

    // ⬇️ MASUK KE TABEL ABSENSI (ADMIN JUGA LIAT INI)
    Absensi::create([
        'id_karyawan' => $request->id_karyawan,
        'tanggal' => $request->tanggal,
        'jam_masuk' => Carbon::now('Asia/Jakarta')->format('H:i'),
        'status_kehadiran' => $request->status_kehadiran,
        'keterangan' => $alasan
    ]);

    return redirect()->route('karyawan.dashboard')
        ->with('success', 'Absensi berhasil');
}
public function absenMasuk(Request $request)
{

    $karyawan = Karyawan::where('id_user', Auth::user()->id)->first();

    if (!$karyawan) {
        return back()->with('error', 'Akun belum terhubung dengan data karyawan');
    }

    // ✅ VALIDASI GPS
    $request->validate([
        'latitude'  => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    // ===============================
    // 📍 VALIDASI RADIUS
    // ===============================
    $officeLat = config('absensi.office_lat');
    $officeLng = config('absensi.office_lng');
    $radius    = config('absensi.radius', 100); // meter

    $earthRadius = 6371000;

    $dLat = deg2rad($request->latitude - $officeLat);
    $dLng = deg2rad($request->longitude - $officeLng);

    $a = sin($dLat/2) * sin($dLat/2) +
         cos(deg2rad($officeLat)) *
         cos(deg2rad($request->latitude)) *
         sin($dLng/2) * sin($dLng/2);

    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $distance = $earthRadius * $c;

    if ($distance > $radius) {
        return back()->with('error', 'Kamu berada di luar radius kantor!');
    }

    // ===============================
    // ⏰ VALIDASI WAKTU
    // ===============================
    $now = Carbon::now('Asia/Jakarta');
    $tanggal = $now->toDateString();

    // $batasMasuk = Carbon::createFromTime(10, 0, 0, 'Asia/Jakarta');

    // if ($now->greaterThan($batasMasuk)) {
    //     return back()->with('error', 'Absen masuk hanya bisa sampai jam 10:00');
    // }

    // ❌ CEK DOUBLE ABSEN
    $cek = Absensi::where('id_karyawan', $karyawan->id_karyawan)
        ->where('tanggal', $tanggal)
        ->first();

    if ($cek) {
        return back()->with('error', 'Kamu sudah absen hari ini');
    }

    // ✅ SIMPAN
    Absensi::create([
        'id_karyawan'      => $karyawan->id_karyawan,
        'tanggal'          => $tanggal,
        'jam_masuk'        => $now->format('H:i:s'),
        'status_kehadiran' => 'Hadir',
    ]);

    return back()->with('success', 'Absen masuk berhasil');
}
public function absenPulang(Request $request)
{

    $karyawan = Karyawan::where('id_user', Auth::user()->id)->first();

    if (!$karyawan) {
        return back()->with('error', 'Akun belum terhubung dengan data karyawan');
    }

    // ✅ VALIDASI GPS
    $request->validate([
        'latitude'  => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    //  VALIDASI RADIUS
    $officeLat = config('absensi.office_lat');
    $officeLng = config('absensi.office_lng');
    $radius    = config('absensi.radius', 100); // meter

    $earthRadius = 6371000;

    $dLat = deg2rad($request->latitude - $officeLat);
    $dLng = deg2rad($request->longitude - $officeLng);

    $a = sin($dLat/2) * sin($dLat/2) +
         cos(deg2rad($officeLat)) *
         cos(deg2rad($request->latitude)) *
         sin($dLng/2) * sin($dLng/2);

    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $distance = $earthRadius * $c;

    if ($distance > $radius) {
        return back()->with('error', 'Kamu berada di luar radius kantor!');
    }


    //  VALIDASI ABSEN
    $now = Carbon::now('Asia/Jakarta');
    $tanggal = $now->toDateString();

    $absensi = Absensi::where('id_karyawan', $karyawan->id_karyawan)
        ->where('tanggal', $tanggal)
        ->first();

    if (!$absensi) {
        return back()->with('error', 'Kamu belum absen masuk');
    }

    if ($absensi->jam_pulang) {
        return back()->with('error', 'Kamu sudah absen pulang');
    }

    // Batas mulai jam 17:00
    // $awalPulang = Carbon::today('Asia/Jakarta')->setHour(17);

    // if ($now->lessThan($awalPulang)) {
    //     return back()->with('error', 'Absen pulang hanya bisa mulai jam 17:00');
    // }

    //  UPDATE JAM PULANG
    $absensi->update([
        'jam_pulang' => $now->format('H:i:s')
    ]);

    return back()->with('success', 'Absen pulang berhasil');
}

//     public function absenIzin(Request $request)
// {
//     $request->validate([
//         'status_kehadiran' => 'required|in:Izin,Sakit',
//         'keterangan' => 'required|min:5'
//     ]);

//     $karyawan = Karyawan::where('id_user', Auth::user()->id)->first();

//     if (!$karyawan) {
//         return back()->with('error','Akun belum terhubung dengan data karyawan');
//     }

//     $tanggal = Carbon::now('Asia/Jakarta')->toDateString();

//     if($request->status_kehadiran == 'Izin')
//     {
//         Izin::create([
//             'karyawan_id' => $karyawan->id_karyawan,
//             'tanggal' => $tanggal,
//             'alasan' => $request->keterangan,
//             'status' => 'pending'
//         ]);
//     }

//     if($request->status_kehadiran == 'Sakit')
//     {
//         Sakit::create([
//             'karyawan_id' => $karyawan->id_karyawan,
//             'tanggal' => $tanggal,
//             'keterangan' => $request->keterangan,
//             'status' => 'pending'
//         ]);
//     }

//     return back()->with('success','Pengajuan berhasil dikirim, menunggu approval manager');
// }

public function absenIzin(Request $request)
{
    $request->validate([
        'status_kehadiran' => 'required|in:Izin,Sakit',
        'alasan' => 'required|min:5'
    ]);

    $karyawan = Karyawan::where('id_user', Auth::user()->id)->first();

    if (!$karyawan) {
        return back()->with('error', 'Akun belum terhubung dengan data karyawan');
    }

    $tanggal = Carbon::now('Asia/Jakarta')->toDateString();

    $cekIzin = Izin::where('karyawan_id', $karyawan->id_karyawan)
        ->where('tanggal', $tanggal)
        ->exists();

    $cekSakit = Sakit::where('karyawan_id', $karyawan->id_karyawan)
        ->where('tanggal', $tanggal)
        ->exists();

    if ($cekIzin || $cekSakit) {
        return back()->with('error', 'Kamu sudah mengajukan izin/sakit hari ini');
    }

    if ($request->status_kehadiran == 'Izin') {
        Izin::create([
            'karyawan_id' => $karyawan->id_karyawan,
            'tanggal' => $tanggal,
            'alasan' => $request->alasan,
            'status' => 'pending'
        ]);
    } else {
        Sakit::create([
            'karyawan_id' => $karyawan->id_karyawan,
            'tanggal' => $tanggal,
            'alasan' => $request->alasan,
            'status' => 'pending'
        ]);
    }

    return back()->with('success', 'Pengajuan berhasil dikirim');
}
// public function absenIzin(Request $request)
// {
//     $request->validate([
//         'status_kehadiran' => 'required|in:Izin,Sakit',
//         'keterangan' => 'required|min:5'
//     ]);

//     $karyawan = Karyawan::where('id_user', Auth::user()->id)->first();

//     if (!$karyawan) {
//         return back()->with('error', 'Akun belum terhubung dengan data karyawan');
//     }

//     $tanggal = Carbon::now('Asia/Jakarta')->toDateString();

//     // Cegah dobel pengajuan di hari yang sama
//     $cek = Izin::where('karyawan_id', $karyawan->id_karyawan)
//         ->where('tanggal', $tanggal)
//         ->exists();

//     if ($cek) {
//         return back()->with('error', 'Kamu sudah mengajukan izin/sakit hari ini');
//     }

//     // =========================
//     // JIKA IZIN
//     // =========================
//     if ($request->status_kehadiran == 'Izin') {

//         Izin::create([
//             'karyawan_id' => $karyawan->id_karyawan,
//             'tanggal' => $tanggal,
//             'alasan' => $request->keterangan,
//             'status' => 'pending'
//         ]);
//     }

//     // =========================
//     // JIKA SAKIT
//     // =========================
//     if ($request->status_kehadiran == 'Sakit') {

//         // masuk tabel sakit
//         Sakit::create([
//             'karyawan_id' => $karyawan->id_karyawan,
//             'tanggal' => $tanggal,
//             'keterangan' => $request->keterangan,
//             'status' => 'pending'
//         ]);

//         // masuk juga tabel izin supaya tampil satu tabel manager
//         Izin::create([
//             'karyawan_id' => $karyawan->id_karyawan,
//             'tanggal' => $tanggal,
//             'alasan' => 'SAKIT - ' . $request->keterangan,
//             'status' => 'pending'
//         ]);
//     }

//     return back()->with('success', 'Pengajuan berhasil dikirim, menunggu approval manager');
// }
// public function izinSakit()
// {
//     $izin = Izin::with('karyawan')->get();
//     $sakit = Sakit::with('karyawan')->get();

//     return view('manager.izin_sakit', compact('izin','sakit'));
// }
// // public function absenIzin(Request $request)
// {
//     $now = Carbon::now('Asia/Jakarta');
//     $tanggal = $now->toDateString();

//     // ⛔ BATAS ABSEN MASUK JAM 10:00
//     $batasMasuk = Carbon::createFromTime(10, 0, 0, 'Asia/Jakarta');

//     if ($now->greaterThan($batasMasuk)) {
//         return back()->with('error', 'Absen izin hanya bisa sampai jam 10:00');
//     }
//     $request->validate([
//         'status_kehadiran' => 'required|in:Izin,Sakit',
//         'keterangan'       => 'required|min:5'
//     ]);


//     // ambil karyawan
//     $karyawan = Karyawan::where('id_user', Auth::user()->id)->first();

//     if (!$karyawan) {
//         return back()->with('error', 'Akun belum terhubung dengan data karyawan');
//     }

//     $tanggal = Carbon::now('Asia/Jakarta')->toDateString();

//     // cegah dobel absensi hari yang sama
//     $sudahAbsen = Absensi::where('id_karyawan', $karyawan->id_karyawan)
//         ->where('tanggal', $tanggal)
//         ->exists();

//     if ($sudahAbsen) {
//         return back()->with('error', 'Kamu sudah melakukan absensi hari ini');
//     }

//     // simpan izin / sakit (TANPA jam masuk & pulang)
//     Absensi::create([
//         'id_karyawan'      => $karyawan->id_karyawan,
//         'tanggal'          => $tanggal,
//         'status_kehadiran' => $request->status_kehadiran,
//         'keterangan'       => $request->keterangan,
//         'jam_masuk'        => null,
//         'jam_pulang'       => null,
//     ]);

//     return back()->with('success', 'Izin berhasil dikirim');
// }
}
