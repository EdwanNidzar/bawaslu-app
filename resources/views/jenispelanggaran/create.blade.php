@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | TAMBAH DATA JENIS PELANGGARAN')

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
            <li class="breadcrumb-item active"><a href="{{ route('jenispelanggaran.index') }}">Jenis Pelanggaran</a></li>
            <li class="breadcrumb-item">Tambah Jenis Pelanggaran</li>
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

            <form method="POST" action="{{ route('jenispelanggaran.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="jenis_pelanggaran">Jenis Pelanggaran</label>
                  <input type="text" class="form-control" name="jenis_pelanggaran" id="jenis_pelanggaran"
                    placeholder="Jenis Pelanggaran" value="{{ old('jenis_pelanggaran') }}" autocomplete="off">
                  @error('jenis_pelanggaran')
                    <div class="alert alert-danger">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('jenispelanggaran.index') }}" type="button" class="btn btn-secondary">Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
