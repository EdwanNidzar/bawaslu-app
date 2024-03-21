<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JenisPelanggaran;

class JenisPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenispelanggaran = DB::table('view_jenis_pelanggaran')->get();
        return view('jenispelanggaran.index', compact('jenispelanggaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenispelanggaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_pelanggaran' => 'required',
        ],[
            'jenis_pelanggaran.required' => 'Jenis pelanggaran harus diisi',
        ]);

        $jenispelanggaran = new JenisPelanggaran;
        $jenispelanggaran->jenis_pelanggaran = $request->jenis_pelanggaran;
        
        if ($jenispelanggaran->save()) {
            return redirect()->route('jenispelanggaran.index')->with('success', 'Jenis Pelanggaran berhasil ditambahkan');
        } else {
            return redirect()->route('jenispelanggaran.index')->with('error', 'Jenis Pelanggaran gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = JenisPelanggaran::where('id', $id)->first();
        return view('jenispelanggaran.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = JenisPelanggaran::where('id', $id)->first();
        return view('jenispelanggaran.show', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenispelanggaran = JenisPelanggaran::findOrFail($id);

        $request->validate([
            'jenis_pelanggaran' => 'required',
        ],[
            'jenis_pelanggaran.required' => 'Jenis pelanggaran harus diisi',
        ]);

        $jenispelanggaran->jenis_pelanggaran = $request->jenis_pelanggaran;

        if ($jenispelanggaran->save()) {
            return redirect()->route('jenispelanggaran.index')->with('success', 'Jenis Pelanggaran berhasil diubah');
        } else {
            return redirect()->route('jenispelanggaran.index')->with('error', 'Jenis Pelanggaran gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenispelanggaran = JenisPelanggaran::findOrFail($id);
        if ($jenispelanggaran->delete()) {
            return redirect()->route('jenispelanggaran.index')->with('success', 'Jenis Pelanggaran berhasil dihapus');
        } else {
            return redirect()->route('jenispelanggaran.index')->with('error', 'Jenis Pelanggaran gagal dihapus');
        }
    }

    /**
     * Retrieve violations related to a specific political party.
     */
    public function pelanggaran($id)
    {
        // Get the type of violation based on its name
        $jenispelanggaran = JenisPelanggaran::where('jenis_pelanggaran', $id)->first();
        
        // Get violations related to this type of violation
        $view_pelanggarans = DB::table('view_pelanggaran')
                            ->where('jenis_pelanggaran_id', $id)
                            ->get();
        
        // Return view with data
        return view('pelanggaran.index', compact('jenispelanggaran', 'view_pelanggarans'));
    }
}
