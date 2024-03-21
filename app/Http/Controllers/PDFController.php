<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    public function cetakParpols()
    {
        $parpol = DB::table('view_partai_politik')->select('*')->get();
        $data = [
            'parpol' => $parpol,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Partai Politik'
        ];

        $report = PDF::loadView('parpol.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakJenisPelanggaran()
    {
        $jenis = DB::table('view_jenis_pelanggaran')->select('*')->get();
        $data = [
            'jenis' => $jenis,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Jenis Pelanggaran'
        ];

        $report = PDF::loadView('jenispelanggaran.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakSuratKerja()
    {
        $jenis = DB::table('view_surat_kerja')->select('*')->get();
        $data = [
            'jenis' => $jenis,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Surat Kerja'
        ];

        $report = PDF::loadView('suratkerja.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakPelanggaran()
    {
        $jenis = DB::table('view_pelanggaran')->select('*')->get();
        $data = [
            'pelanggaran' => $jenis,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Pelanggaran'
        ];

        $report = PDF::loadView('pelanggaran.print', $data)->setPaper('A4', 'landscape');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakLaporanPelanggaran()
    {
        $laporan = DB::table('view_laporan')->select('*')->get();
        $data = [
            'laporan' => $laporan,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Laporan Pelanggaran'
        ];

        $report = PDF::loadView('laporan.print', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakParpolsById($id)
    {
        $parpol = DB::table('view_partai_politik')->select('*')->where('partai_id', $id)->get();
        $data = [
            'parpol' => $parpol,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Partai Politik By ID'
        ];

        $report = PDF::loadView('parpol.printbyid', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakJenisPelanggaranById($id)
    {
        $jenis = DB::table('view_jenis_pelanggaran')->select('*')->where('id_jenis_pelanggaran', $id)->get();
        $data = [
            'jenis' => $jenis,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Jenis Pelanggaran By ID'
        ];

        $report = PDF::loadView('jenispelanggaran.printbyid', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakSuratKerjaById($id)
    {
        $jenis = DB::table('view_surat_kerja')->select('*')->where('surat_kerja_id', $id)->get();
        $data = [
            'jenis' => $jenis,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Surat Kerja By ID'
        ];

        $report = PDF::loadView('suratkerja.printbyid', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakPelanggaranById($id) 
    { 
        $pelanggaran = DB::table('view_pelanggaran')->select('*')->where('pelanggaran_id', $id)->get();
        $data = [
            'pelanggaran' => $pelanggaran,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Pelanggaran By ID'
        ];

        $report = PDF::loadView('pelanggaran.printbyid', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }

    public function cetakLaporanPelanggaranById($id)
    {
        $laporan = DB::table('view_laporan')->select('*')->where('laporan_id', $id)->get();
        $data = [
            'laporan' => $laporan,
            'tanggal' => date('d F Y'),
            'judul' => 'Laporan Data Laporan Pelanggaran By ID'
        ];

        $report = PDF::loadView('laporan.printbyid', $data)->setPaper('A4', 'potrait');
        $nama_tgl = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('d/m/y'),6,2);
        $nama_jam = substr(date('d/m/y'),0,2).substr(date('d/m/y'),3,2).substr(date('h:i:s'),6,2);

        return $report->stream('report_'.$nama_tgl.$nama_jam.'.pdf');
    }
}
