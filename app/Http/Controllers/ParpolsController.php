<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Parpols;

class ParpolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parpols = DB::table('view_partai_politik')->get();
        return view('parpol.index', compact('parpols'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('parpol.create');
    }

    /**
     * handle upload file to cloudinary
     */
    public function upload(Request $request)
    {
        $path = 'bawaslu-app/parpol';
        $file = $request->file('photo')->getClientOriginalName();

        $fileName = pathinfo($file, PATHINFO_FILENAME);

        $publicId = date('Y-m-d_His') . '_' . $fileName;
        $upload = Cloudinary::upload($request->file('photo')->getRealPath(), [
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
            'nomor_partai' => 'required',
            'nama_partai' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'nomor_partai.required' => 'Nomor Partai wajib diisi',
            'nama_partai.required' => 'Nama Partai wajib diisi',
            'photo.required' => 'Photo wajib diisi',
            'photo.image' => 'Photo harus berupa gambar',
            'photo.mimes' => 'Photo harus berformat jpeg, png, jpg, gif',
            'photo.max' => 'Photo maksimal berukuran 2MB',
        ]);

        $parpol = new Parpols;
        $parpol->nomor_partai = $request->nomor_partai; 
        $parpol->nama_partai = $request->nama_partai;

        $upload = $this->upload($request);
        $parpol->photo = $upload->getSecurePath();

        if ($parpol->save()) {
            return redirect()->route('parpols.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('parpols.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Parpols::where('id', $id)->first();
        return view('parpol.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Parpols::where('id', $id)->first();
        return view('parpol.show', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $parpol = Parpols::findOrFail($id);

        $request->validate([
            'nomor_partai' => 'required',
            'nama_partai' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nomor_partai.required' => 'Nomor Partai wajib diisi',
            'nama_partai.required' => 'Nama Partai wajib diisi',
            'photo.image' => 'Photo harus berupa gambar',
            'photo.mimes' => 'Photo harus berformat jpeg, png, jpg, gif',
            'photo.max' => 'Photo maksimal berukuran 2MB',
        ]);

        $parpol->nomor_partai = $request->nomor_partai; 
        $parpol->nama_partai = $request->nama_partai;

        if ($request->hasFile('photo')) {
            $upload = $this->upload($request);
            $parpol->photo = $upload->getSecurePath();
        }

        if ($parpol->update()) {
            return redirect()->route('parpols.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('parpols.index')->with('error', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parpol = Parpols::where('id', $id)->first();
        if ($parpol->delete()) {
            return redirect()->route('parpols.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('parpols.index')->with('error', 'Data gagal dihapus');
        }
    }

    /**
     * Retrieve violations related to a specific political party.
     */
    public function pelanggaran($id)
    {
        $parpol = Parpols::where('id', $id)->first();

        $view_pelanggarans = DB::table('view_pelanggaran')
                        ->where('partai_id', $id)
                        ->get();

        return view('pelanggaran.index', compact('parpol', 'view_pelanggarans'));
    }
}
