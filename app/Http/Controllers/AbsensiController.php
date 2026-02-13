<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use Carbon\Carbon;
use App\Models\Libur;
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
            'search'  => $search,
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


public function absenIzin(Request $request)
{
    $now = Carbon::now('Asia/Jakarta');
    $tanggal = $now->toDateString();

    // ⛔ BATAS ABSEN MASUK JAM 10:00
    // $batasMasuk = Carbon::createFromTime(10, 0, 0, 'Asia/Jakarta');

    // if ($now->greaterThan($batasMasuk)) {
    //     return back()->with('error', 'Absen izin hanya bisa sampai jam 10:00');
    // }
    $request->validate([
        'status_kehadiran' => 'required|in:Izin,Sakit',
        'keterangan'       => 'required|min:5'
    ]);


    // ambil karyawan
    $karyawan = Karyawan::where('id_user', Auth::user()->id)->first();

    if (!$karyawan) {
        return back()->with('error', 'Akun belum terhubung dengan data karyawan');
    }

    $tanggal = Carbon::now('Asia/Jakarta')->toDateString();

    // cegah dobel absensi hari yang sama
    $sudahAbsen = Absensi::where('id_karyawan', $karyawan->id_karyawan)
        ->where('tanggal', $tanggal)
        ->exists();

    if ($sudahAbsen) {
        return back()->with('error', 'Kamu sudah melakukan absensi hari ini');
    }

    // simpan izin / sakit (TANPA jam masuk & pulang)
    Absensi::create([
        'id_karyawan'      => $karyawan->id_karyawan,
        'tanggal'          => $tanggal,
        'status_kehadiran' => $request->status_kehadiran,
        'keterangan'       => $request->keterangan,
        'jam_masuk'        => null,
        'jam_pulang'       => null,
    ]);

    return back()->with('success', 'Izin berhasil dikirim');
}
}
