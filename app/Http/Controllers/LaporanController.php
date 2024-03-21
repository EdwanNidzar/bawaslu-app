<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Verif;
use App\Models\Laporan;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $view_laporans = DB::table('view_laporan')->get();
        return view('laporan.index', compact('view_laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = DB::table('view_pelanggaran')->get();
        return view('laporan.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggaran_id' => 'required',
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ],[
            'pelanggaran_id.required' => 'Pelanggaran harus diisi',
            'provinsi_id.required' => 'Provinsi harus diisi',
            'kota_id.required' => 'Kota harus diisi',
            'kecamatan_id.required' => 'Kecamatan harus diisi',
            'kelurahan_id.required' => 'Kelurahan harus diisi',
            'latitude.required' => 'Latitude harus diisi',
            'longitude.required' => 'Longitude harus diisi',
        ]);

        $laporan = new Laporan();
        $laporan->pelanggaran_id = $request->pelanggaran_id;
        $laporan->provinsi_id = $request->provinsi_id;
        $laporan->kota_id = $request->kota_id;
        $laporan->kecamatan_id = $request->kecamatan_id;
        $laporan->kelurahan_id = $request->kelurahan_id;
        $laporan->latitude = $request->latitude;
        $laporan->longitude = $request->longitude;

        if ($laporan->save()) {
            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan');
        } else {
            return redirect()->route('laporan.index')->with('error', 'Laporan gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        $data = DB::table('view_laporan')->get()->where('laporan_id', $id)->first();
        return view('laporan.show', compact('laporan','data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        $data = DB::table('view_pelanggaran')->get();
        return view('laporan.edit', compact('data', 'laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'pelanggaran_id' => 'required',
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ],[
            'pelanggaran_id.required' => 'Pelanggaran harus diisi',
            'provinsi_id.required' => 'Provinsi harus diisi',
            'kota_id.required' => 'Kota harus diisi',
            'kecamatan_id.required' => 'Kecamatan harus diisi',
            'kelurahan_id.required' => 'Kelurahan harus diisi',
            'latitude.required' => 'Latitude harus diisi',
            'longitude.required' => 'Longitude harus diisi',
        ]);

        $laporan->pelanggaran_id = $request->pelanggaran_id;
        $laporan->provinsi_id = $request->provinsi_id;
        $laporan->kota_id = $request->kota_id;
        $laporan->kecamatan_id = $request->kecamatan_id;
        $laporan->kelurahan_id = $request->kelurahan_id;
        $laporan->latitude = $request->latitude;
        $laporan->longitude = $request->longitude;

        if ($laporan->update()) {
            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diubah');
        } else {
            return redirect()->route('laporan.index')->with('error', 'Laporan gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        if ($laporan->delete()) {
            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus');
        } else {
            return redirect()->route('laporan.index')->with('error', 'Laporan gagal dihapus');
        }
    }

    /**
     * Verify the specified resource.
     */
    public function verify(string $id)
    {
        $verif = Verif::where('laporan_id', $id)->first();

        if ($verif) {
            $verif->status = 1;
            $verif->save();
        } else {
            $verif = new Verif();
            $verif->laporan_id = $id;
            $verif->status = 1;
            $verif->save();
        }

        if ($verif) {
            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diverifikasi');
        } else {
            return redirect()->route('laporan.index')->with('error', 'Laporan gagal diverifikasi');
        }
   
    }

    /**
     * Reject the specified resource.
     */
    public function reject(string $id)
    {
        $verif = Verif::where('laporan_id', $id)->first();

        if ($verif) {
            $verif->status = 2;
            $verif->save();
        } else {
            $verif = new Verif();
            $verif->laporan_id = $id;
            $verif->status = 2;
            $verif->save();
        }

        if ($verif) {
            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditolak');
        } else {
            return redirect()->route('laporan.index')->with('error', 'Laporan gagal ditolak');
        }
    }

}
