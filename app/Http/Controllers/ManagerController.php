<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Izin;
use App\Models\Sakit;
use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Overtime;
use App\Models\Absensi;

class ManagerController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD MANAGER
    |--------------------------------------------------------------------------
    */

    public function dashboard(Request $request)
    {
        $jumlah_karyawan = Karyawan::count();

        $cuti_pending = Cuti::where('status','pending')->count();
        $cuti_disetujui = Cuti::where('status','disetujui')->count();
        $cuti_ditolak = Cuti::where('status','ditolak')->count();

        $overtime_pending = Overtime::where('status','pending')->count();
        $overtime_approved = Overtime::where('status','approved')->count();
        $overtime_rejected = Overtime::where('status','rejected')->count();

        $izin_pending = Izin::where('status','pending')->count();
        $izin_disetujui = Izin::where('status','disetujui')->count();
        $izin_ditolak = Izin::where('status','ditolak')->count();

        $sakit_pending = Sakit::where('status','pending')->count();
        $sakit_disetujui = Sakit::where('status','disetujui')->count();
        $sakit_ditolak = Sakit::where('status','ditolak')->count();

        $absensi_hari_ini = Absensi::whereDate('tanggal', Carbon::today())->count();

        // DATA UNTUK GRAFIK
        $chartAbsensi = Absensi::selectRaw('DATE(tanggal) as tanggal,
                SUM(CASE WHEN status_kehadiran IN ("Hadir", "Terlambat") THEN 1 ELSE 0 END) as masuk,
                SUM(CASE WHEN status_kehadiran = "Cuti" THEN 1 ELSE 0 END) as cuti,
                SUM(CASE WHEN status_kehadiran = "Izin" THEN 1 ELSE 0 END) as izin,
                SUM(CASE WHEN status_kehadiran = "Sakit" THEN 1 ELSE 0 END) as sakit
            ')
            ->whereYear('tanggal', Carbon::now()->year)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereDate('tanggal', '<=', Carbon::today())
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // AMBIL BULAN & TAHUN DARI FILTER
        $filterBulan = $request->get('bulan', Carbon::now()->month);
        $filterTahun = $request->get('tahun', Carbon::now()->year);
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $filterBulan, $filterTahun);

        // DATA UNTUK REKAP BULANAN
        $rekapBulanan = Karyawan::select('karyawan.id_karyawan', 'karyawan.nama_karyawan')
            ->leftJoin('absensi', function ($join) use ($filterBulan, $filterTahun) {
                $join->on('karyawan.id_karyawan', '=', 'absensi.id_karyawan')
                     ->whereMonth('absensi.tanggal', $filterBulan)
                     ->whereYear('absensi.tanggal', $filterTahun)
                     ->whereIn('absensi.status_kehadiran', ['Izin', 'Sakit']);
            })
            ->selectRaw('
                karyawan.id_karyawan, karyawan.nama_karyawan,
                COALESCE(SUM(CASE WHEN absensi.status_kehadiran = "Izin" THEN 1 ELSE 0 END), 0) as total_izin,
                COALESCE(SUM(CASE WHEN absensi.status_kehadiran = "Sakit" THEN 1 ELSE 0 END), 0) as total_sakit
            ')
            ->groupBy('karyawan.id_karyawan', 'karyawan.nama_karyawan')
            ->orderBy('karyawan.nama_karyawan')
            ->get()
            ->filter(function ($item) {
                return $item->total_izin > 0 || $item->total_sakit > 0;
            })
            ->values()
            ->map(function ($item) use ($jumlahHari) {
                $pi = $jumlahHari > 0 ? round(($item->total_izin / $jumlahHari) * 100, 1) : 0;
                $ps = $jumlahHari > 0 ? round(($item->total_sakit / $jumlahHari) * 100, 1) : 0;
                return [
                    'nama'         => $item->nama_karyawan,
                    'persen_izin'  => $pi,
                    'persen_sakit' => $ps,
                    'persen_total' => round($pi + $ps, 1),
                ];
            });

        $avgIzin  = $rekapBulanan->count() > 0 ? round($rekapBulanan->avg('persen_izin'), 1) : 0;
        $avgSakit = $rekapBulanan->count() > 0 ? round($rekapBulanan->avg('persen_sakit'), 1) : 0;
        $avgTotal = $rekapBulanan->count() > 0 ? round($rekapBulanan->avg('persen_total'), 1) : 0;

        $notif = $this->notif();

        return view('manager.dashboard', array_merge(compact(
            'jumlah_karyawan', 'chartAbsensi', 'absensi_hari_ini',
            'rekapBulanan', 'jumlahHari', 'avgIzin', 'avgSakit', 'avgTotal',
            'filterBulan', 'filterTahun',
            'cuti_pending', 'cuti_disetujui', 'cuti_ditolak',
            'overtime_pending', 'overtime_approved', 'overtime_rejected',
            'izin_pending', 'izin_disetujui', 'izin_ditolak',
            'sakit_pending', 'sakit_disetujui', 'sakit_ditolak'
        ), $notif));
    }


    /*
    |--------------------------------------------------------------------------
    | NOTIFIKASI SIDEBAR
    |--------------------------------------------------------------------------
    */

    private function notif()
    {
        $izin_pending = Izin::where('status','pending')->count();
        $sakit_pending = Sakit::where('status','pending')->count();

        return [
            'izin_pending' => $izin_pending,
            'sakit_pending' => $sakit_pending,
            'total_notif' => $izin_pending + $sakit_pending
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | DATA KARYAWAN
    |--------------------------------------------------------------------------
    */

    public function karyawan()
    {
        $karyawan = Karyawan::orderBy('nama_karyawan','asc')->get();
        return view('manager.karyawan-index', compact('karyawan'));
    }


    /*
    |--------------------------------------------------------------------------
    | PERSETUJUAN LEMBUR
    |--------------------------------------------------------------------------
    */

    public function overtime(): View
    {
        $overtimes = Overtime::with('karyawan')->orderBy('tanggal','desc')->get();
        return view('manager.overtime-index', compact('overtimes'));
    }


    /*
    |--------------------------------------------------------------------------
    | DATA IZIN
    |--------------------------------------------------------------------------
    */

    public function izin()
    {
        $dataIzin = Izin::with('karyawan')->get()->map(function ($item) {
            $item->jenis_pengajuan = 'Izin';
            $item->isi = $item->alasan;
            $item->source = 'izin';
            return $item;
        });

        $dataSakit = Sakit::with('karyawan')->get()->map(function ($item) {
            $item->jenis_pengajuan = 'Sakit';
            $item->isi = $item->alasan;
            $item->source = 'sakit';
            return $item;
        });

        $data = $dataIzin->concat($dataSakit)->sortByDesc('tanggal')->values();
        return view('manager.izin', compact('data'));
    }

    public function izinSakit()
    {
        $izin = Izin::with('karyawan')->get()->map(function ($item) {
            $item->jenis = 'Izin';
            $item->isi = $item->alasan;
            return $item;
        });

        $sakit = Sakit::with('karyawan')->get()->map(function ($item) {
            $item->jenis = 'Sakit';
            $item->isi = $item->alasan;
            return $item;
        });

        $data = $izin->concat($sakit)->sortByDesc('tanggal');
        return view('manager.izin', compact('data'));
    }


    /*
    |--------------------------------------------------------------------------
    | DATA SAKIT
    |--------------------------------------------------------------------------
    */

    public function sakit()
    {
        $data = Sakit::where('status','pending')->get();
        return view('manager.sakit', compact('data'));
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVE IZIN
    |--------------------------------------------------------------------------
    */

    public function approveIzin($id)
    {
        $izin = Izin::findOrFail($id);
        $izin->status = 'disetujui';
        $izin->save();

        Absensi::create([
            'id_karyawan' => $izin->karyawan_id,
            'tanggal' => $izin->tanggal,
            'status_kehadiran' => 'Izin',
            'alasan' => $izin->alasan,
            'jam_masuk' => null,
            'jam_pulang' => null
        ]);

        return redirect()->back()->with('success','Izin berhasil di approve');
    }

    public function rejectIzin($id)
    {
        $izin = Izin::findOrFail($id);
        $izin->status = 'ditolak';
        $izin->save();

        return redirect()->back()->with('success','Izin ditolak');
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVE SAKIT
    |--------------------------------------------------------------------------
    */

    public function approveSakit($id)
    {
        $sakit = Sakit::findOrFail($id);
        $sakit->status = 'disetujui';
        $sakit->save();

        Absensi::create([
            'id_karyawan' => $sakit->karyawan_id,
            'tanggal' => $sakit->tanggal,
            'status_kehadiran' => 'Sakit',
            'alasan' => $sakit->alasan,
            'jam_masuk' => null,
            'jam_pulang' => null
        ]);

        return redirect()->back()->with('success','Sakit berhasil disetujui');
    }

    public function rejectSakit($id)
    {
        $sakit = Sakit::findOrFail($id);
        $sakit->status = 'ditolak';
        $sakit->save();

        return redirect()->back()->with('success','Sakit berhasil ditolak');
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL KEHADIRAN (KLIK CHART)
    |--------------------------------------------------------------------------
    */

    public function detailKehadiran(Request $request)
    {
        try {
            $tanggal = $request->tanggal;

            $izin = Absensi::with('karyawan')
                ->whereDate('tanggal', $tanggal)
                ->where('status_kehadiran', 'Izin')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama'       => $item->karyawan->nama_karyawan ?? '-',
                        'keterangan' => $item->alasan ?? '-',
                    ];
                });

            $sakit = Absensi::with('karyawan')
                ->whereDate('tanggal', $tanggal)
                ->where('status_kehadiran', 'Sakit')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama'       => $item->karyawan->nama_karyawan ?? '-',
                        'keterangan' => $item->alasan ?? '-',
                    ];
                });

            return response()->json([
                'success' => true,
                'izin'    => $izin,
                'sakit'   => $sakit,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | LAPORAN MANAGER
    |--------------------------------------------------------------------------
    */

    public function laporan()
    {
        $laporan = Absensi::with('karyawan')->orderBy('tanggal','desc')->get();
        $cuti = Cuti::with('karyawan')->orderBy('tanggal_mulai','desc')->get();
        $lembur = Overtime::with('karyawan')->orderBy('tanggal','desc')->get();
        $izin = Izin::with('karyawan')->orderBy('tanggal','desc')->get();
        $sakit = Sakit::with('karyawan')->orderBy('tanggal','desc')->get();

        $rekap = Karyawan::select('nama_karyawan')
            ->withCount([
                'absensi as hadir' => function ($q) {
                    $q->where('status_kehadiran','Hadir');
                },
                'absensi as terlambat' => function ($q) {
                    $q->where('status_kehadiran','Terlambat');
                },
                'absensi as alpha' => function ($q) {
                    $q->where('status_kehadiran','Alpha');
                }
            ])
            ->get();

        return view('manager.laporan-index', compact(
            'laporan', 'cuti', 'lembur', 'izin', 'sakit', 'rekap'
        ));
    }

}
