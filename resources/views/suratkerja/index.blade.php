@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | DATA SURAT KERJA')

@section('content')

  @if (session('success'))
    <div id="success-alert" class="alert alert-success">
      {{ session('success') }}
    </div>
    <script>
      setTimeout(function() {
        document.getElementById('success-alert').style.display = 'none';
      }, 3000);
    </script>
  @elseif (session('error'))
    <div id="error-alert" class="alert alert-danger">
      {{ session('error') }}
    </div>
    <script>
      setTimeout(function() {
        document.getElementById('error-alert').style.display = 'none';
      }, 3000);
    </script>
  @endif

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">@yield('judul_halaman')</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">HOME</a></li>
            <li class="breadcrumb-item">Surat Kerja</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">@yield('judul_halaman')</h3>
      </div>

      <div class="card-body">
        <a href="{{ route('suratkerja.create') }}" type="button" class="btn btn-primary mb-3"><i
            class="bi bi-plus"></i></a>
        <a href="{{ route('cetakSuratKerja') }}" target="_blank" type="button" class="btn btn-success mb-3"><i
            class="bi bi-printer"></i></a>
        <table id="suratkerja" class="table table-bordered  table-striped mb-3">
          <thead>
            <tr align="center">
              <th>NO</th>
              <th>Surat Kerja</th>
              <th>Nama Bawaslu</th>
              <th>Nama Panwascam</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($suratkerjas as $data)
              <tr align="center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nomor_surat_kerja }}</td>
                <td>{{ $data->bawaslu_kota_name }}</td>
                <td>{{ $data->panwascam_name }}</td>
                <td>
                  <a href="{{ route('suratkerja.show', $data->surat_kerja_id) }}"> <button class="btn btn-light m-2"><i
                        class="bi bi-eye-fill"></i></button></a>
                  <a href="{{ route('cetakSuratKerjaById', $data->surat_kerja_id) }}" target="_blank" type="button"
                    class="btn btn-success m-2"><i class="bi bi-printer"></i></a>
                  <a href="{{ route('suratkerja.edit', $data->surat_kerja_id) }}"> <button class="btn btn-secondary m-2"
                      target="_blank"><i class="bi bi-pencil-square"></i></button></a>
                  <form action="{{ route('suratkerja.destroy', $data->surat_kerja_id) }}" method="POST"
                    onsubmit="return confirm('Apakah yakin menghapus data ini?')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger m-2"><i class="bi bi-trash-fill"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
