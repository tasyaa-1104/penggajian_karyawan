<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cuti;

class FinanceController extends Controller
{
   public function dashboard()
{

    $total_tunjangan = \App\Models\Tunjangan::sum('nominal');
    $total_gaji = \App\Models\Gaji::sum('gaji_bersih');

    $labels_tunjangan = [];
    $values_tunjangan = [];

    $labels_gaji = [];
    $values_gaji = [];

    return view('finance.dashboard', compact(
        'total_tunjangan',
        'total_gaji',
        'labels_tunjangan',
        'values_tunjangan',
        'labels_gaji',
        'values_gaji'
    ));

}
}
