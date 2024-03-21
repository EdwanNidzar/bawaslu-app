@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | EDIT DATA PELANGGARAN')

@section('content')
  <section class="content">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('judul_halaman')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">HOME</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('pelanggaran.index') }}">Pelanggaran</a></li>
              <li class="breadcrumb-item">Edit Pelanggaran</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">@yield('judul_halaman')</h3>
            </div>

            <form method="POST" action="{{ route('pelanggaran.update', $data->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="jenis_pelanggaran">Jenis pelanggaran</label>
                      <select name="jenis_pelanggaran" id="jenis_pelanggaran" class="form-control">
                        <option value="#" disabled>.: PILIH JENIS PELANGGARAN :.</option>
                        @foreach ($jenis_pelanggaran as $item)
                          <option value="{{ $item->id }}"
                            {{ $item->id == $data->jenis_pelanggaran_id ? 'selected' : '' }}>
                            {{ $item->jenis_pelanggaran }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="nama_partai">Partai</label>
                      <select name="nama_partai" id="nama_partai" class="form-control">
                        <option value="#" disabled>.: PILIH PARTAI :.</option>
                        @foreach ($parpol as $item)
                          <option value="{{ $item->id }}" {{ $item->id == $data->partai_id ? 'selected' : '' }}>
                            {{ $item->nama_partai }}
                          </option>
                        @endforeach
                      </select>
                      @error('nama_partai')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="status">Status Peserta Pemilu</label>
                      <select name="status" id="status" class="form-control">
                        <option value="#" disabled selected>.: PILIH STATUS PESERTA PEMILU :.</option>
                        <option value="DPD RI" {{ $data->status == 'DPD RI' ? 'selected' : '' }}>DPD RI</option>
                        <option value="DPR DI" {{ $data->status == 'DPR DI' ? 'selected' : '' }}>DPR RI</option>
                        <option value="DPRD Provinsi" {{ $data->status == 'DPRD Provinsi' ? 'selected' : '' }}>DPRD
                          Provinsi</option>
                        <option value="DPRD Kota" {{ $data->status == 'DPRD Kota' ? 'selected' : '' }}>DPRD Kota</option>
                      </select>
                      @error('status')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="dapil">Dapil</label>
                      <select name="dapil" id="dapil" class="form-control">
                        <option value="#" disabled selected>.: PILIH DAPIL :.</option>
                      </select>
                      @error('dapil')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="nama_bacaleg">Nama Bacaleg</label>
                      <input type="text" class="form-control" name="nama_bacaleg" id="nama_bacaleg"
                        placeholder="Masukan Nama Bacaleg" autocomplete="off"
                        value="{{ old('nama_bacaleg', $data->nama_bacaleg) }}">
                      @error('nama_bacaleg')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama_bacaleg">Keterangan</label>
                  <textarea id="keterangan" name="keterangan" class="form-control">{{ old('keterangan', $data->keterangan) }}</textarea>
                  @error('keterangan')
                    <div class="alert alert-danger mt-2">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="tgl">Tanggal Input</label>
                      <input type="date" class="form-control" name="tgl" id="tgl"
                        value="{{ $data->tanggal_input }}">
                      @error('tgl')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="bukti">Bukti Pendukung</label>
                      <input type="file" class="form-control" name="bukti" id="bukti" accept="image/*" multiple>
                      @if ($data->bukti)
                        <img src="{{ $data->bukti }}" alt="Photo Partai" width="100" height="100">
                      @endif
                      @error('bukti')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror

                    </div>
                  </div>
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="{{ route('pelanggaran.index') }}" type="button" class="btn btn-secondary">Kembali</a>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
