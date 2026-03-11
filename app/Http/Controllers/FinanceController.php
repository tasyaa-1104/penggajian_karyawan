<?php

namespace App\Http\Controllers;

use App\Models\Tunjangan;
use App\Models\Gaji;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function dashboard()
    {

        /*
        ============================
        TOTAL
        ============================
        */

        $total_tunjangan = Tunjangan::sum('nominal');
        $total_gaji = Gaji::sum('gaji_bersih');


        /*
        ============================
        KOMPONEN TUNJANGAN OTOMATIS
        ============================
        */

        $tunjangan_list = Tunjangan::select(
            'nama_tunjangan',
            DB::raw('SUM(nominal) as total')
        )
        ->groupBy('nama_tunjangan')
        ->get();



        /*
        ============================
        DATA CHART TUNJANGAN
        ============================
        */

        $labels_tunjangan = $tunjangan_list->pluck('nama_tunjangan');
        $values_tunjangan = $tunjangan_list->pluck('total');



        /*
        ============================
        ANALISIS GAJI PER BULAN
        ============================
        */

        $data_gaji = Gaji::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('SUM(gaji_bersih) as total')
        )
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

        $labels_gaji = [];
        $values_gaji = [];

        foreach ($data_gaji as $row) {

            $labels_gaji[] = date("F", mktime(0,0,0,$row->bulan,1));
            $values_gaji[] = $row->total;

        }



        return view('finance.dashboard', compact(
            'total_tunjangan',
            'total_gaji',
            'tunjangan_list',
            'labels_tunjangan',
            'values_tunjangan',
            'labels_gaji',
            'values_gaji'
        ));
    }
}
