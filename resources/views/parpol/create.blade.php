@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | TAMBAH DATA PARTAI POLITIK')

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
              <li class="breadcrumb-item active"><a href="{{ route('parpols.index') }}">Partai Politik</a></li>
              <li class="breadcrumb-item">Tambah Partai Politik</li>
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

            <form method="POST" action="{{ route('parpols.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="nomor_partai">Nomor Partai</label>
                  <input type="number" class="form-control" name="nomor_partai" id="nomor_partai"
                    placeholder="Masukan Nomor Partai" autocomplete="off">
                  @error('nomor_partai')
                    <div class="alert alert-danger mt-2">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="nama_partai">Nama Partai</label>
                  <input type="text" class="form-control" name="nama_partai" id="nomor_partai"
                    placeholder="Masukan Nama Partai" autocomplete="off">
                  @error('nomor_partai')
                    <div class="alert alert-danger mt-2">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="gambar">Gambar Partai</label>
                  <input type="file" class="form-control" @error('photo') is-invalid @enderror" name="photo"
                    id="gambar" accept="image/*" multiple>
                  @error('photo')
                    <div class="alert alert-danger mt-2">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('parpols.index') }}" type="button" class="btn btn-secondary">Kembali</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
