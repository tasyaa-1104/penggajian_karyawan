<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Tunjangan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{

public function index(Request $request)
{
    $search = $request->search;

    $karyawans = Karyawan::with(['divisi','jabatan','user','tunjangan'])
        ->when($search, function ($q) use ($search) {
            $q->where('nik', 'like', "%$search%")
              ->orWhere('nama_karyawan', 'like', "%$search%");
        })
        ->orderBy('id_karyawan','desc')
        ->get();

    $role = Auth::user()->role;

    if($role == 'finance'){
        return view('finance.karyawan-finance', compact('karyawans','search'));
    }

    if($role == 'manager'){
        return view('manager.karyawan-index', compact('karyawans','search'));
    }

    // default untuk HRD
    return view('admin.karyawan', compact('karyawans','search'));
}

    public function create()
    {
        return view('admin.karyawan-create', [
            'divisi'    => Divisi::all(),
            'jabatan'   => Jabatan::all(),
            'users'     => User::where('role','karyawan')->get(),
            'tunjangan' => Tunjangan::all(), // 🔥 tambah ini
        ]);
    }
     public function tunjangan($id)
    {
        $karyawan = \App\Models\Karyawan::findOrFail($id);
        $tunjangan = \App\Models\Tunjangan::all();

        return view('finance.karyawan-tunjangan', compact('karyawan', 'tunjangan'));
    }
   public function simpanTunjangan(Request $request, $id)
{
    $karyawan = Karyawan::findOrFail($id);

    // Simpan tunjangan
    $karyawan->tunjangan()->sync($request->tunjangan);

    // Redirect ke halaman daftar gaji
    return redirect()->route('gaji.index')
                     ->with('success','Tunjangan berhasil disimpan');
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
        try {
            $user    = User::findOrFail($request->id_user);
            $jabatan = Jabatan::findOrFail($request->id_jabatan);

            $karyawan = Karyawan::create([
                'id_user'         => $user->id,
                'nik'             => $request->nik,
                'nama_karyawan'   => $user->nama,
                'id_divisi'       => $request->id_divisi,
                'id_jabatan'      => $request->id_jabatan,
                'gaji_pokok'      => $jabatan->gaji_pokok,
                'status_karyawan' => $request->status_karyawan,
                'tanggal_masuk'   => now()->toDateString(),
            ]);

            // 🔥 SIMPAN TUNJANGAN
            if ($request->tunjangan) {
                $karyawan->tunjangan()->attach($request->tunjangan);
            }

            return redirect()->route('karyawan')
                ->with('success','Karyawan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambah karyawan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.karyawan-edit', [
            'karyawan' => Karyawan::findOrFail($id),
            'divisi'   => Divisi::all(),
            'jabatan'  => Jabatan::all(),
            'tunjangan' => Tunjangan::all(), // 🔥 tambah ini
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
        try {
            $user = User::findOrFail($request->id_user);
            $karyawan = Karyawan::findOrFail($id);

            $karyawan->update([
                'id_user'         => $user->id,
                'nik'             => $request->nik,
                'nama_karyawan'   => $user->nama,
                'id_divisi'       => $request->id_divisi,
                'id_jabatan'      => $request->id_jabatan,
                'gaji_pokok'      => $request->gaji_pokok,
                'status_karyawan' => $request->status_karyawan,
            ]);

            // 🔥 UPDATE TUNJANGAN
            if ($request->tunjangan) {
                $karyawan->tunjangan()->sync($request->tunjangan);
            } else {
                $karyawan->tunjangan()->detach();
            }

            return redirect()->route('karyawan')
                ->with('success','Karyawan berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal update karyawan: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $deleted = Karyawan::where('id_karyawan',$id)->delete();
            if (!$deleted) {
                return redirect()->route('karyawan')->with('error', 'Karyawan tidak ditemukan atau gagal dihapus');
            }
            return redirect()->route('karyawan')->with('success','Karyawan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('karyawan')->with('error', 'Gagal menghapus karyawan: ' . $e->getMessage());
        }
    }

     public function dashboardKaryawan()
    {
        $userId = Auth::id();

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

        // Ambil riwayat absensi
        $absensi = Absensi::where('id_karyawan', $karyawan->id_karyawan)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Ambil riwayat cuti (pastikan relasi/model Cuti ada)
        $cuti = [];
        if (method_exists($karyawan, 'cuti')) {
            $cuti = $karyawan->cuti()->orderBy('tanggal_mulai', 'desc')->get();
        } elseif (class_exists('App\\Models\\Cuti')) {
            $cuti = \App\Models\Cuti::where('id_karyawan', $karyawan->id_karyawan)
                ->orderBy('tanggal_mulai', 'desc')
                ->get();
        }

        return view('karyawan-dashboard', compact(
            'karyawan',
            'totalHadir',
            'totalIzin',
            'totalAlpha',
            'absensi',
            'cuti'
        ));
    }

    public function exportPdf()
    {
        $karyawans = Karyawan::with('divisi','jabatan')->get();

        $pdf = Pdf::loadView('admin.karyawan_pdf', compact('karyawans'))
                ->setPaper('A4', 'landscape');

        return $pdf->download('Data_Karyawan.pdf');
    }

}
