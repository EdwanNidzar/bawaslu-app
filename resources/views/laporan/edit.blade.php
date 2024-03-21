@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | EDIT DATA LAPORAN PELANGGARAN')

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">@yield('judul_halaman')</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">HOME</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('laporan.index') }}">Laporan Pelanggaran</a></li>
            <li class="breadcrumb-item">Edit Laporan Pelanggaran</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">@yield('judul_halaman')</h3>
            </div>

            <form method="POST" action="{{ route('laporan.update', $laporan->id) }}">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="pelanggaran_id">Jenis pelanggaran</label>
                  <select name="pelanggaran_id" id="pelanggaran_id" class="form-control">
                    <option value="#" disabled selected>.: PILIH PELANGGARAN :.</option>
                    @foreach ($data as $item)
                      <option value="{{ $item->pelanggaran_id }}"
                        {{ $item->pelanggaran_id == $laporan->pelanggaran_id ? 'selected' : '' }}>
                        {{ $item->nama_bacaleg }} | {{ $item->jenis_pelanggaran }}
                      </option>
                    @endforeach
                  </select>
                  @error('pelanggaran_id')
                    <div class="alert alert-danger mt-2">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                @foreach ($data as $item)
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group item" id="item_{{ $item->pelanggaran_id }}" style="display: none;">
                        <label for="partai_id">Nama Partai</label>
                        <input readonly type="text" class="form-control nama_partai" value="{{ $item->nama_partai }}">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group item" id="status_item_{{ $item->pelanggaran_id }}" style="display: none;">
                        <label for="partai_id">Status Peserta Pemilu</label>
                        <input readonly type="text" class="form-control status_peserta"
                          value="{{ $item->status_peserta_pemilu }}">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group item" id="nama_bacaleg_item_{{ $item->pelanggaran_id }}"
                        style="display: none;">
                        <label for="partai_id">Nama Bacaleg</label>
                        <input readonly type="text" class="form-control nama_bacaleg"
                          value="{{ $item->nama_bacaleg }}">
                      </div>
                    </div>
                  </div>

                  <div class="form-group item" id="bukti_item_{{ $item->pelanggaran_id }}" style="display: none;">
                    <label for="partai_id">Bukti</label><br>
                    <img src="{{ $item->bukti }}" alt="Bukti" class="img-fluid">
                  </div>

                  <div class="form-group item" id="keterangan_item_{{ $item->pelanggaran_id }}" style="display: none;">
                    <label for="partai_id">Keterangan</label><br>
                    <textarea readonly class="form-control keterangan" cols="30" rows="10">{{ $item->keterangan }}</textarea>
                  </div>
                @endforeach

                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="select2-provinsi">Provinsi</label>
                    <select name="provinsi_id" class="form-control select2-data-array browser-default"
                      id="select2-provinsi"></select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="select2-kabupaten">Kabupaten / Kota</label>
                    <select name="kota_id" class="form-control select2-data-array browser-default"
                      id="select2-kabupaten"></select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="select2-kecamatan">Kecamatan</label>
                    <select name="kecamatan_id" class="form-control select2-data-array browser-default"
                      id="select2-kecamatan"></select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="select2-kelurahan">Kelurahan / Desa</label>
                    <select name="kelurahan_id" class="form-control select2-data-array browser-default"
                      id="select2-kelurahan"></select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-6">
                    <label for="latitude">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude"
                      value="{{ $laporan->latitude }}">
                  </div>
                  <div class="col-md-6">
                    <label for="longitude">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude"
                      value="{{ $laporan->longitude }}">
                  </div>
                </div>

                <br>
                <div id="mapid" style="height: 400px;"></div>
                <br>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="{{ route('laporan.index') }}" type="button" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
