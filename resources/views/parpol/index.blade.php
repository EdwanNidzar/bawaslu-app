@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | DATA PARTAI POLITIK')

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
            <li class="breadcrumb-item">Partai Politik</li>
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
        <a href="{{ route('parpols.create') }}" type="button" class="btn btn-primary mb-3"><i class="bi bi-plus"></i></a>
        <a href="{{ route('cetakParpols') }}" target="_blank" type="button" class="btn btn-success mb-3"><i
            class="bi bi-printer"></i></a>

        <table id="parpols" class="table table-bordered  table-striped mb-3">
          <thead>
            <tr align="center">
              <th>NO</th>
              <th>Nomor Partai</th>
              <th>Nama Partai</th>
              <th>Photo Partai</th>
              <th>Jumlah Pelanggaran</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($parpols as $data)
              <tr align="center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nomor_partai }}</td>
                <td>{{ $data->nama_partai }}</td>
                <td>
                  <img src="{{ $data->photo_partai }}" alt="Photo Partai" width="100" height="100">
                </td>
                <td>{{ $data->jumlah_pelanggaran }}</td>
                <td>
                  <a href="{{ route('parpols.edit', $data->partai_id) }}"> <button class="btn btn-secondary m-2"><i
                        class="bi bi-pencil-square"></i></button></a>
                  <form action="{{ route('parpols.destroy', $data->partai_id) }}" method="POST"
                    onsubmit="return confirm('Apakah yakin menghapus data ini?')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger m-2"><i class="bi bi-trash-fill"></i></button>
                  </form>
                  <a href="{{ route('parpols.show', $data->partai_id) }}"> <button class="btn btn-light m-2"><i
                        class="bi bi-eye-fill"></i></button></a>
                  <a href="{{ route('parpols.pelanggaran', $data->partai_id) }}"> <button class="btn btn-info m-2"><i
                        class="bi bi-eye-fill"></i></button></a>
                  <a href="{{ route('cetakParpolsById', $data->partai_id) }}" target="_blank" type="button"
                    class="btn btn-success m-2"><i class="bi bi-printer"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
