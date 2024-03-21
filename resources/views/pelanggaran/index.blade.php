@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | DATA PELANGGARAN')

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
            <li class="breadcrumb-item">Pelanggaran</li>
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
        <a href="{{ route('pelanggaran.create') }}" type="button" class="btn btn-primary mb-3"><i
            class="bi bi-plus"></i></a>
        <a href="{{ route('cetakPelanggaran') }}" target="_blank" type="button" class="btn btn-success mb-3"><i
            class="bi bi-printer"></i></a>
        <table id="pelanggaran" class="table table-bordered  table-striped mb-3">
          <thead>
            <tr align="center">
              <th>NO</th>
              <th>Jenis Pelanggaran</th>
              <th>Nama Partai</th>
              <th>Status Peserta Pemilu</th>
              <th>Nama Peserta Pemilu</th>
              <th>Dapil</th>
              <th>Bukti Pendukung</th>
              <th>Tanggal</th>
              <th>Keterangan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($view_pelanggarans as $data)
              <tr align="center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->jenis_pelanggaran }}</td>
                <td>{{ $data->nama_partai }}</td>
                <td>{{ $data->status_peserta_pemilu }}</td>
                <td>{{ $data->nama_bacaleg }}</td>
                <td>{{ $data->dapil }}</td>
                <td>
                  <img src="{{ $data->bukti }}" alt="Bukti Pendukung" width="25%" height="25%">
                </td>
                <td>{{ $data->tanggal_input }}</td>
                <td>{{ $data->keterangan }}</td>
                <td>
                  <a href="{{ route('pelanggaran.show', $data->pelanggaran_id) }}"> <button class="btn btn-light m-2"><i
                        class="bi bi-eye-fill"></i></button></a>
                  <a href="{{ route('cetakPelanggaranById', $data->pelanggaran_id) }}" target="_blank" type="button"
                    class="btn btn-success m-2"><i class="bi bi-printer"></i></a>
                  <a href="{{ route('pelanggaran.edit', $data->pelanggaran_id) }}"> <button
                      class="btn btn-secondary m-2"><i class="bi bi-pencil-square"></i></button></a>
                  <form action="{{ route('pelanggaran.destroy', $data->pelanggaran_id) }}" method="POST"
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
