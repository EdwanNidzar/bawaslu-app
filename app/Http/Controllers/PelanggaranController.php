<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JenisPelanggaran;
use App\Models\Parpols;
use App\Models\Pelanggaran;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $view_pelanggarans = DB::table('view_pelanggaran')->get();
        return view('pelanggaran.index', compact('view_pelanggarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_pelanggaran = JenisPelanggaran::orderBy('id', 'ASC')->get();
        $parpol = Parpols::orderBy('id', 'ASC')->get();
        return view('pelanggaran.create', compact('jenis_pelanggaran', 'parpol'));
    }

    /**
     * handle upload file to cloudinary
     */
    public function upload(Request $request)
    {
        $path = 'bawaslu-app/pelanggaran';
        $file = $request->file('bukti')->getClientOriginalName();

        $fileName = pathinfo($file, PATHINFO_FILENAME);

        $publicId = date('Y-m-d_His') . '_' . $fileName;
        $upload = Cloudinary::upload($request->file('bukti')->getRealPath(), [
            'folder' => $path,
            'public_id' => $publicId
        ]);

        return $upload;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_pelanggaran' => 'required',
            'nama_partai' => 'required',
            'status' => 'required',
            'nama_bacaleg' => 'required',
            'dapil' => 'required',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',    
            'tgl' => 'required',
            'keterangan' => 'required',
        ],[
            'jenis_pelanggaran.required' => 'Jenis Pelanggaran tidak boleh kosong',
            'nama_partai.required' => 'Nama Partai tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'nama_bacaleg.required' => 'Nama Bacaleg tidak boleh kosong',
            'dapi.required' => 'Dapil tidak boleh kosong',
            'bukti.required' => 'Bukti tidak boleh kosong',
            'bukti.image' => 'Bukti harus berupa gambar',
            'bukti.mimes' => 'Bukti harus berformat jpeg, png, jpg, gif',
            'bukti.max' => 'Bukti maksimal berukuran 2MB',
            'tgl.required' => 'Tanggal tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
        ]);

        $pelanggaran = new Pelanggaran;
        $pelanggaran->jenis_pelanggaran_id = $request->jenis_pelanggaran;
        $pelanggaran->partai_id = $request->nama_partai;
        $pelanggaran->status_peserta_pemilu = $request->status;
        $pelanggaran->nama_bacaleg = $request->nama_bacaleg;
        $pelanggaran->dapil = $request->dapil;
        
        $upload = $this->upload($request);
        $pelanggaran->bukti = $upload->getSecurePath();

        $pelanggaran->tanggal_input = $request->tgl;
        $pelanggaran->keterangan = $request->keterangan;

        if ($pelanggaran->save()) {
            return redirect()->route('pelanggaran.index')->with('success', 'Pelanggaran berhasil ditambahkan');
        } else {
            return redirect()->route('pelanggaran.index')->with('error', 'Pelanggaran gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $view_pelanggarans = DB::table('view_pelanggaran')->where('pelanggaran_id', $id)->first();
        return view('pelanggaran.show', compact('view_pelanggarans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Pelanggaran::where('id', $id)->first();
        
        $jenis_pelanggaran = JenisPelanggaran::orderBy('id', 'ASC')->get();
        $parpol = Parpols::orderBy('id', 'ASC')->get();

        return view('pelanggaran.edit', compact('data', 'jenis_pelanggaran', 'parpol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);

        $request->validate([
            'jenis_pelanggaran' => 'required',
            'nama_partai' => 'required',
            'status' => 'required',
            'nama_bacaleg' => 'required',
            'dapil' => 'required',
            'bukti' => 'image|mimes:jpeg,png,jpg,gif|max:2048',    
            'tgl' => 'required',
            'keterangan' => 'required',
        ],[
            'jenis_pelanggaran.required' => 'Jenis Pelanggaran tidak boleh kosong',
            'nama_partai.required' => 'Nama Partai tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'nama_bacaleg.required' => 'Nama Bacaleg tidak boleh kosong',
            'dapi.required' => 'Dapil tidak boleh kosong',
            'bukti.image' => 'Bukti harus berupa gambar',
            'bukti.mimes' => 'Bukti harus berformat jpeg, png, jpg, gif',
            'bukti.max' => 'Bukti maksimal berukuran 2MB',
            'tgl.required' => 'Tanggal tidak boleh kosong',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
        ]);

        $pelanggaran->jenis_pelanggaran_id = $request->jenis_pelanggaran;
        $pelanggaran->partai_id = $request->nama_partai;
        $pelanggaran->status_peserta_pemilu = $request->status;
        $pelanggaran->nama_bacaleg = $request->nama_bacaleg;
        $pelanggaran->dapil = $request->dapil;

        if ($request->hasFile('bukti')) {
            $upload = $this->upload($request);
            $pelanggaran->bukti = $upload->getSecurePath();
        }

        $pelanggaran->tanggal_input = $request->tgl;
        $pelanggaran->keterangan = $request->keterangan;

        if ($pelanggaran->update()) {
            return redirect()->route('pelanggaran.index')->with('success', 'Pelanggaran berhasil diubah');
        } else {
            return redirect()->route('pelanggaran.index')->with('error', 'Pelanggaran gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        if ($pelanggaran->delete()) {
            return redirect()->route('pelanggaran.index')->with('success', 'Pelanggaran berhasil dihapus');
        } else {
            return redirect()->route('pelanggaran.index')->with('error', 'Pelanggaran gagal dihapus');
        }
    }
}
