@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | DATA LAPORAN PELANGGARAN')

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
            <li class="breadcrumb-item">Laporan Pelanggaran</li>
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
        <a href="{{ route('laporan.create') }}" type="button" class="btn btn-primary mb-3"><i class="bi bi-plus"></i></a>
        <a href="#" target="_blank" type="button" class="btn btn-success mb-3"><i class="bi bi-printer"></i></a>
        <table id="laporan" class="table table-bordered table-striped mb-3">
          <thead>
            <tr align="center">
              <th>NO</th>
              <th>Nama Peserta Pemilu</th>
              <th>Jenis Pelanggaran</th>
              <th>Nama Partai</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($view_laporans as $data)
              <tr align="center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama_bacaleg }}</td>
                <td>{{ $data->jenis_pelanggaran }}</td>
                <td>{{ $data->nama_partai }}</td>
                <td>
                  @if ($data->status == 0)
                    <span class="badge badge-warning">Belum Verif</span>
                  @elseif ($data->status == 1)
                    <span class="badge badge-success">Verif</span>
                  @elseif ($data->status == 2)
                    <span class="badge badge-danger">Reject</span>
                  @endif
                </td>

                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('laporan.show', $data->laporan_id) }}" class="btn btn-light m-2"><i
                        class="bi bi-eye-fill"></i></a>
                    <a href="#" target="_blank" class="btn btn-success m-2"><i class="bi bi-printer"></i></a>
                    @if (auth()->user()->hasRole('bawaslu-kota'))
                      @if ($data->status == 0)
                        <form action="{{ route('laporan.verify', $data->laporan_id) }}" method="POST"
                          onsubmit="return confirm('Apakah yakin menyetujui data ini?')">
                          @csrf
                          @method('POST')
                          <button type="submit" class="btn btn-primary m-2"><i class="fas fa-check"></i></button>
                        </form>
                        <form action="{{ route('laporan.reject', $data->laporan_id) }}" method="POST"
                          onsubmit="return confirm('Apakah yakin tidak menyetujui data ini?')">
                          @csrf
                          @method('POST')
                          <button type="submit" class="btn btn-danger m-2"><i class="fas fa-times"></i></button>
                        </form>
                      @endif
                    @endif

                    @if ($data->status == 0)
                      @if (auth()->user()->hasRole('panwascam'))
                        <a href="{{ route('laporan.edit', $data->laporan_id) }}" class="btn btn-secondary m-2"><i
                            class="bi bi-pencil-square"></i></a>
                      @endif
                      @if (auth()->user()->hasRole('bawaslu-kota') || auth()->user()->hasRole('panwascam'))
                        <form action="{{ route('laporan.destroy', $data->laporan_id) }}" method="POST"
                          onsubmit="return confirm('Apakah yakin menghapus data ini?')" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger m-2"><i class="bi bi-trash-fill"></i></button>
                        </form>
                      @endif
                    @endif

                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
