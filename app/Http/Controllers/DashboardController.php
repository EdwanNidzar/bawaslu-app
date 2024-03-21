<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $parpols = DB::table('view_partai_politik')->get();
        $jenis_pelanggaran = DB::table('view_jenis_pelanggaran')->get();
        $view_laporans = DB::table('view_laporan')->get();
        return view('dashboard', compact('parpols', 'jenis_pelanggaran', 'view_laporans'));
    }
}
