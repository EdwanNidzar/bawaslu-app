@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | SHOW DATA LAPORAN PELANGGARAN')

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
            <li class="breadcrumb-item">Show Laporan Pelanggaran</li>
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

            <form method="POST" action="{{ $laporan->id }}">
              @csrf
              <div class="card-body">
                <div class="form-row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="pelanggaran_id">Jenis pelanggaran</label>
                      <input readonly class="form-control" type="text" value="{{ $data->jenis_pelanggaran }}">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="partai_id">Nama Partai</label>
                      <input readonly type="text" class="form-control" value="{{ $data->nama_partai }}">
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-4">
                    <div class="form-group data">
                      <label for="partai_id">Status Peserta Pemilu</label>
                      <input readonly type="text" class="form-control" value="{{ $data->status_peserta_pemilu }}">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group data">
                      <label for="partai_id">Dapil</label>
                      <input readonly type="text" class="form-control" value="{{ $data->dapil }}">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group data" id="nama_bacaleg">
                      <label for="partai_id">Nama Bacaleg</label>
                      <input readonly type="text" class="form-control nama_bacaleg" value="{{ $data->nama_bacaleg }}">
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="provinsi">Provinsi</label>
                    <input type="text" class="form-control" value="{{ $data->provinsi_nama }}" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="kota">Kota / Kabupaten</label>
                    <input type="text" class="form-control" value="{{ $data->kota_nama }}" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="kecamatan">Kecamatan</label>
                    <input type="text" class="form-control" value="{{ $data->kecamatan_nama }}" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="kelurahan">Kelurahan / Desa</label>
                    <input type="text" class="form-control" value="{{ $data->kelurahan_nama }}" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10" readonly>{{ $data->keterangan }}</textarea>
                </div>

                <input type="hidden" name="latitude" id="latitude" value="{{ $data->latitude }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ $data->longitude }}">

                <br>
                <div id="mapid" style="height: 400px;"></div>
                <br>

                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                <script>
                  var latitude = parseFloat(document.getElementById('latitude').value);
                  var longitude = parseFloat(document.getElementById('longitude').value);
                  var mymap = L.map('mapid').setView([latitude, longitude], 13);

                  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
                  }).addTo(mymap);

                  L.marker([latitude, longitude]).addTo(mymap)
                    .bindPopup("<b>Nama: {{ $data->nama_bacaleg }}</b>" + "<p>Dapil: {{ $data->dapil }}</p>" +
                      "<p>Keterangan : {{ $data->keterangan }}</p>" +
                      "<img src='{{ $data->bukti }}' alt='Bukti' style='width: 50px; height: 50px;'>").openPopup();
                </script>

                <div class="card-footer">
                  <a href="{{ route('laporan.index') }}" type="button" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
