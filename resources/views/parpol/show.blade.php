@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | SHOW DATA PARTAI POLITIK')

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
              <li class="breadcrumb-item">Show Partai Politik</li>
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
                    placeholder="Masukan Nomor Partai" autocomplete="off" value="{{ $data->nomor_partai }}" readonly>

                </div>
                <div class="form-group">
                  <label for="nama_partai">Nama Partai</label>
                  <input type="text" class="form-control" name="nama_partai" id="nomor_partai"
                    placeholder="Masukan Nama Partai" autocomplete="off" value="{{ $data->nama_partai }}" readonly>

                </div>
                <div class="form-group">
                  <label for="gambar">Gambar Partai</label>
                  <div class="row">
                    @if ($data->photo)
                      <img src="{{ $data->photo }}" alt="Photo Partai" width="100" height="100">
                    @endif
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <a href="{{ route('parpols.index') }}" type="button" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('parpols.edit', $data->id) }}" type="button" class="btn btn-primary">Edit</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
