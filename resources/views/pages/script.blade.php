<script>
  $('#parpols').DataTable();
</script>

<script>
  $('#jenispelanggaran').DataTable();
</script>

<script>
  $('#pelanggaran').DataTable();
</script>

<script>
  $('#laporan').DataTable();
</script>

<script>
  $('#users').DataTable();
</script>

<script>
  $('#suratkerja').DataTable();
</script>

<script>
  $(document).ready(function() {
    $('#pelanggaran_id').change(function() {
      var pelanggaran_id = $(this).val();
      $('.item').hide();
      $('#item_' + pelanggaran_id + ', #status_item_' + pelanggaran_id + ', #nama_bacaleg_item_' +
          pelanggaran_id + ', #bukti_item_' + pelanggaran_id)
        .show();
    });
  });
</script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  var map = L.map('mapid').setView([-3.316694, 114.590111], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
  }).addTo(map);

  var marker;

  function updateLatLng(lat, lng) {
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lng;
  }

  map.on('click', function(e) {
    if (marker) {
      map.removeLayer(marker);
    }
    marker = L.marker(e.latlng).addTo(map);
    updateLatLng(e.latlng.lat, e.latlng.lng);
  });
</script>
<script>
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>
<script>
  $(document).ready(function() {
    $('#status').change(function() {
      var status = $(this).val();
      if (status == 'DPD RI') {
        $('#dapil').html(
          '<option value="Kalimantan Selatan">Kalimantan Selatan</option>'
        );
      } else if (status == 'DPR DI') {
        $('#dapil').html(
          '<option value="Kalimantan Selatan 1">Kalimantan Selatan 1</option><option value="Kalimantan Selatan 2">Kalimantan Selatan 2</option>'
        );
      } else if (status == 'DPRD Provinsi') {
        $('#dapil').html(
          '<option value="Kalimantan Selatan 1">Kalimantan Selatan 1</option>' +
          '<option value="Kalimantan Selatan 2">Kalimantan Selatan 2</option>' +
          '<option value="Kalimantan Selatan 3">Kalimantan Selatan 3</option>' +
          '<option value="Kalimantan Selatan 4">Kalimantan Selatan 4</option>' +
          '<option value="Kalimantan Selatan 5">Kalimantan Selatan 5</option>' +
          '<option value="Kalimantan Selatan 6">Kalimantan Selatan 6</option>' +
          '<option value="Kalimantan Selatan 7">Kalimantan Selatan 7</option>'
        );
      } else if (status == 'DPRD Kota') {
        $('#dapil').html(
          '<option value="#" disabled selected>.: PILIH DAPIL :.</option>' +
          '<optgroup label="Kabupaten Tanah Laut">' +
          '<option value="Tanah Laut 1">Tanah Laut 1</option>' +
          '<option value="Tanah Laut 2">Tanah Laut 2</option>' +
          '<option value="Tanah Laut 3">Tanah Laut 3</option>' +
          '<option value="Tanah Laut 4">Tanah Laut 4</option>' +
          '</optgroup>' +
          '<optgroup label="Kabupaten Kotabaru">' +
          '<option value="Kotabaru 1">Kotabaru 1</option>' +
          '<option value="Kotabaru 2">Kotabaru 2</option>' +
          '<option value="Kotabaru 3">Kotabaru 3</option>' +
          '<option value="Kotabaru 4">Kotabaru 4</option>' +
          '</optgroup>' +
          '<optgroup label="Kabupaten Banjar">' +
          '<option value="Banjar 1">Banjar 1</option>' +
          '<option value="Banjar 2">Banjar 2</option>' +
          '<option value="Banjar 3">Banjar 3</option>' +
          '<option value="Banjar 4">Banjar 4</option>' +
          '<option value="Banjar 5">Banjar 5</option>' +
          '</optgroup>' +
          '<optgroup label="Kabupaten Banjar">' +
          '<option value="Barito Kuala 1">Barito Kuala 1</option>' +
          '<option value="Barito Kuala 2">Barito Kuala 2</option>' +
          '<option value="Barito Kuala 3">Barito Kuala 3</option>' +
          '<option value="Barito Kuala 4">Barito Kuala 4</option>' +
          '<option value="Barito Kuala 5">Barito Kuala 5</option>' +
          '</optgroup>' +
          '<optgroup label="Kabupaten Tapin">' +
          '<option value="Tapin 1">Tapin 1</option>' +
          '<option value="Tapin 2">Tapin 2</option>' +
          '<option value="Tapin 3">Tapin 3</option>' +
          '</optgroup>' +
          '<optgroup label="Kabupaten Hulu Sungai Selatan">' +
          '<option value="Hulu Sungai Selatan 1">Hulu Sungai Selatan 1</option>' +
          '<option value="Hulu Sungai Selatan 2">Hulu Sungai Selatan 2</option>' +
          '<option value="Hulu Sungai Selatan 3">Hulu Sungai Selatan 3</option>' +
          '</optgroup>' +
          '<optgroup label="Kabupaten Hulu Sungai Tengah">' +
          '<option value="Hulu Sungai Tengah 1">Hulu Sungai Tengah 1</option>' +
          '<option value="Hulu Sungai Tengah 2">Hulu Sungai Tengah 2</option>' +
          '<option value="Hulu Sungai Tengah 3">Hulu Sungai Tengah 3</option>' +
          '<option value="Hulu Sungai Tengah 4">Hulu Sungai Tengah 4</option>' +
          '<option value="Hulu Sungai Tengah 5">Hulu Sungai Tengah 5</option>' +
          '</optgroup>' +
          '<optgroup label="Kabupaten Hulu Sungai Utara">' +
          '<option value="Hulu Sungai Utara 1">Hulu Sungai Utara 1</option>' +
          '<option value="Hulu Sungai Utara 2">Hulu Sungai Utara 2</option>' +
          '<option value="Hulu Sungai Utara 3">Hulu Sungai Utara 3</option>' +
          '<option value="Hulu Sungai Utara 4">Hulu Sungai Utara 4</option>' +
          '</optgroup>' +
          '<optgroup label="Kabupaten Tabalong">' +
          '<option value="Tabalong 1">Tabalong 1</option>' +
          '<option value="Tabalong 2">Tabalong 2</option>' +
          '<option value="Tabalong 3">Tabalong 3</option>' +
          '<option value="Tabalong 4">Tabalong 4</option>' +
          '</optgroup>' +
          '<optgroup label="Kabupaten Tanah Bumbu">' +
          '<option value="Tanah Bumbu 1">Tanah Bumbu 1</option>' +
          '<option value="Tanah Bumbu 2">Tanah Bumbu 2</option>' +
          '<option value="Tanah Bumbu 3">Tanah Bumbu 3</option>' +
          '<option value="Tanah Bumbu 4">Tanah Bumbu 4</option>' +
          '</optgroup>' +
          '<optgroup label="Kabupaten Balangan">' +
          '<option value="Balangan 1">Balangan 1</option>' +
          '<option value="Balangan 2">Balangan 2</option>' +
          '<option value="Balangan 3">Balangan 3</option>' +
          '</optgroup>' +
          '<optgroup label="Kota Banjarmasin">' +
          '<option value="Kota Banjarmasin 1">Kota Banjarmasin 1</option>' +
          '<option value="Kota Banjarmasin 2">Kota Banjarmasin 2</option>' +
          '<option value="Kota Banjarmasin 3">Kota Banjarmasin 3</option>' +
          '<option value="Kota Banjarmasin 4">Kota Banjarmasin 4</option>' +
          '<option value="Kota Banjarmasin 5">Kota Banjarmasin 5</option>' +
          '</optgroup>' +
          '<optgroup label="Kota Banjarbaru">' +
          '<option value="Kota Banjarbaru 1">Kota Banjarbaru 1</option>' +
          '<option value="Kota Banjarbaru 2">Kota Banjarbaru 2</option>' +
          '<option value="Kota Banjarbaru 3">Kota Banjarbaru 3</option>' +
          '<option value="Kota Banjarbaru 4">Kota Banjarbaru 4</option>' +
          '</optgroup>' +
          '</optgroup>'
        );
      } else {
        $('#dapil').html('<option value="#" disabled selected>.: PILIH DAPIL :.</option>');
      }
    });
  });
</script>
<script>
  var urlProvinsi = "https://ibnux.github.io/data-indonesia/provinsi.json";
  var urlKabupaten = "https://ibnux.github.io/data-indonesia/kabupaten/";
  var urlKecamatan = "https://ibnux.github.io/data-indonesia/kecamatan/";
  var urlKelurahan = "https://ibnux.github.io/data-indonesia/kelurahan/";

  function clearOptions(id) {
    console.log("on clearOptions :" + id);

    //$('#' + id).val(null);
    $('#' + id).empty().trigger('change');
  }

  console.log('Load Provinsi...'); //ini yg muncul
  $.getJSON(urlProvinsi, function(res) {

    res = $.map(res, function(obj) {
      obj.text = obj.nama
      return obj;
    });

    data = [{
      id: "",
      nama: "- Pilih Provinsi -",
      text: "- Pilih Provinsi -"
    }].concat(res);

    //implemen data ke select provinsi
    $("#select2-provinsi").select2({
      dropdownAutoWidth: true,
      width: '100%',
      data: data
    })
  });

  var selectProv = $('#select2-provinsi');
  $(selectProv).change(function() {
    var value = $(selectProv).val();
    clearOptions('select2-kabupaten');

    if (value) {
      console.log("on change selectProv");

      var text = $('#select2-provinsi :selected').text();
      console.log("value = " + value + " / " + "text = " + text);

      console.log('Load Kabupaten di ' + text + '...')
      $.getJSON(urlKabupaten + value + ".json", function(res) {

        res = $.map(res, function(obj) {
          obj.text = obj.nama
          return obj;
        });

        data = [{
          id: "",
          nama: "- Pilih Kabupaten -",
          text: "- Pilih Kabupaten -"
        }].concat(res);

        //implemen data ke select provinsi
        $("#select2-kabupaten").select2({
          dropdownAutoWidth: true,
          width: '100%',
          data: data
        })
      })
    }
  });

  var selectKab = $('#select2-kabupaten');
  $(selectKab).change(function() {
    var value = $(selectKab).val();
    clearOptions('select2-kecamatan');

    if (value) {
      console.log("on change selectKab");

      var text = $('#select2-kabupaten :selected').text();
      console.log("value = " + value + " / " + "text = " + text);

      console.log('Load Kecamatan di ' + text + '...')
      $.getJSON(urlKecamatan + value + ".json", function(res) {

        res = $.map(res, function(obj) {
          obj.text = obj.nama
          return obj;
        });

        data = [{
          id: "",
          nama: "- Pilih Kecamatan -",
          text: "- Pilih Kecamatan -"
        }].concat(res);

        //implemen data ke select provinsi
        $("#select2-kecamatan").select2({
          dropdownAutoWidth: true,
          width: '100%',
          data: data
        })
      })
    }
  });

  var selectKec = $('#select2-kecamatan');
  $(selectKec).change(function() {
    var value = $(selectKec).val();
    clearOptions('select2-kelurahan');

    if (value) {
      console.log("on change selectKec");

      var text = $('#select2-kecamatan :selected').text();
      console.log("value = " + value + " / " + "text = " + text);

      console.log('Load Kelurahan di ' + text + '...')
      $.getJSON(urlKelurahan + value + ".json", function(res) {

        res = $.map(res, function(obj) {
          obj.text = obj.nama
          return obj;
        });

        data = [{
          id: "",
          nama: "- Pilih Kelurahan -",
          text: "- Pilih Kelurahan -"
        }].concat(res);

        //implemen data ke select provinsi
        $("#select2-kelurahan").select2({
          dropdownAutoWidth: true,
          width: '100%',
          data: data
        })
      })
    }
  });

  var selectKel = $('#select2-kelurahan');
  $(selectKel).change(function() {
    var value = $(selectKel).val();

    if (value) {
      console.log("on change selectKel");

      var text = $('#select2-kelurahan :selected').text();
      console.log("value = " + value + " / " + "text = " + text);
    }
  });
</script>
