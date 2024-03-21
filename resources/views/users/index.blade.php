@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | DATA USERS')

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
            <li class="breadcrumb-item">Users</li>
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
        <div class="row align-items-center">
          <button class="btn btn-primary m-2"><i class="bi bi-person-fill"></i></button>
          <span class="align-middle"><i style="color: red">*</i><em>Mengubah Menjadi Roles Bawaslu Provinsi</em></span>
        </div>
        <div class="row align-items-center">
          <button class="btn btn-secondary m-2"><i class="bi bi-person-fill"></i></button>
          <span class="align-middle"><i style="color: red">*</i><em>Mengubah Menjadi Roles Bawaslu Kota</em></span>
        </div>
        <div class="row align-items-center">
          <button class="btn btn-light m-2"><i class="bi bi-person-fill"></i></button>
          <span class="align-middle"><i style="color: red">*</i><em>Mengubah Menjadi Roles Panwaslu</em></span>
        </div>
      </div>


      <div class="card-body">
        <table id="users" class="table table-bordered  table-striped mb-3">
          <thead>
            <tr align="center">
              <th>NO</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $data)
              <tr align="center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->username }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->roles }}</td>
                <td>
                  <form action="{{ route('users.makeProvinsi', $data->id) }}" method="POST"
                    onsubmit="return confirm('Apakah yakin mengubah role ini?')" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-primary m-2"><i class="bi bi-person-fill"></i></button>
                  </form>
                  <form action="{{ route('users.makeKota', $data->id) }}" method="POST"
                    onsubmit="return confirm('Apakah yakin mengubah role ini?')" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-secondary m-2"><i class="bi bi-person-fill"></i></button>
                  </form>
                  <form action="{{ route('users.makePanwascam', $data->id) }}" method="POST"
                    onsubmit="return confirm('Apakah yakin mengubah role ini?')" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-light m-2"><i class="bi bi-person-fill"></i></button>
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
