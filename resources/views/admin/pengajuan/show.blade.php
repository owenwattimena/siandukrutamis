@extends('templates.index')
@section('head')
<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection
@section('content')
<h3>Pengajuan</h3>
<div class="card">
    <div class="card-body">

        @csrf
        <div class="row g-3">
            <div class="col-sm-12">
                <label for="inputNIK" class="form-label">NIK</label>
                <input type="text" class="form-control" id="inputNIK" placeholder="Masukan NIK" name="nik" value="{{ $pengajuan->nik }}" required disabled>
                <div class="invalid-feedback">Valid first name is required.</div>
            </div>
            <div class="col-sm-12">
                <label for="inputNkk" class="form-label">Nama Kepala Keluarga</label>
                <input type="text" class="form-control" id="inputNkk" placeholder="Masukan Nama Kepala Keluarga" name="nama_kepala_keluarga" value="{{ $pengajuan->nama_kepala_keluarga }}" required disabled>
                <div class="invalid-feedback">Valid first name is required.</div>
            </div>
            <div class="col-sm-12">
                <label for="inputJak" class="form-label">Jumlah Anggota Keluarga</label>
                <input type="number" class="form-control" id="inputJak" placeholder="Masukan Jumlah Anggota Keluarga" name="jumlah_anggota_keluarga" value="{{ $pengajuan->jumlah_anggota_keluarga }}" required disabled>
                <div class="invalid-feedback">Valid first name is required.</div>
            </div>
            <div class="col-sm-12">
                <label for="inputPekerjaan" class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" id="inputPekerjaan" placeholder="Masukan Pekerjaan" name="pekerjaan" required value="{{ $pengajuan->pekerjaan }}" disabled>
                <div class="invalid-feedback">Valid first name is required.</div>
            </div>
            <div class="col-sm-12">
                <label for="inputGaji" class="form-label">Gaji/Bulan</label>
                <input type="text" class="form-control" id="inputGaji" placeholder="Masukan Gaji/Bulan" name="gaji" required value="{{ $pengajuan->gaji }}" disabled>
                <div class="invalid-feedback">Valid first name is required.</div>
            </div>
            <div class="col-sm-12">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Masukan Email" name="email" value="{{ $pengajuan->email }}" required disabled>
                <div class="invalid-feedback">Valid first name is required.</div>
            </div>
            <div class="col-sm-12">
                <label for="inputAlamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="inputAlamat" placeholder="Masukan Alamat" name="alamat" required disabled>{{ $pengajuan->alamat }}</textarea>
                <div class="invalid-feedback">Valid first name is required.</div>
            </div>
            <div class="col-sm-12">
                <label for="inputmap" class="form-label">Lokasi Rumah di Peta</label>
                <div id="map" class="map map-home" style="height: 500px; margin-top: 50px"></div>
                <input type="hidden" name="latitude" value="{{ $pengajuan->latitude }}" id="inputLatitude">
                <input type="hidden" name="longitude" value="{{ $pengajuan->longitude }}" id="inputLongitude">
                <div class="invalid-feedback">Valid first name is required.</div>
            </div>
            <form action="{{ route('admin.pengajuan.status', $pengajuan->id) }}" method="post">
                @csrf
                <div class="col-sm-12">
                    <button type="submit" value="terima" name="status" class="btn btn-primary w-100" onclick="return confirm('Yakin ingin menerima data?')">Terima</button>
                    <button type="submit" value="tolak" name="status" class="btn btn-danger w-100 mt-3" onclick="return confirm('Yakin ingin menolak data?')">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
{{-- <script src="https://gist.github.com/Fingel/6252fc9a2596f8c2c071.js"></script> --}}
<script>
    var lat, lon;

    lat = $('#inputLatitude').val();
    lon = $('#inputLongitude').val();

    var osmUrl = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png'
        , osmAttrib = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        , osm = L.tileLayer(osmUrl, {
            maxZoom: 18
            , attribution: osmAttrib
        });

    const successCallback = (position) => {

        var map = L.map('map').setView([lat, lon], 15).addLayer(osm);

        var theMarker = {};

        map.on('click', function(e) {
            lat = e.latlng.lat;
            lon = e.latlng.lng;


            console.log("You clicked the map at LAT: " + lat + " and LONG: " + lon);
            //Clear existing marker,

        });
        if (theMarker != undefined) {
            map.removeLayer(theMarker);
        };

        //Add a marker to show where you clicked.
        theMarker = L.marker([lat, lon]).addTo(map);

    };

    var watchID, timerID, lastCheckedPosition;
    var locationEventCount = 0;
    options = {};
    options.maxWait = 10000; // Default 10 seconds
    options.desiredAccuracy = 20; // Default 20 meters
    options.timeout = options.maxWait; // Default to maxWait

    options.maximumAge = 0; // Force current locations only
    options.enableHighAccuracy = true; // Force high accuracy (otherwise, why are you using this function?)
    function onWait() {
        // el = document.getElementById("locate-icon");
        // el.classList.remove("ion-pinpoint");
        // el.classList.add("ion-loading-a");
        console.log("waiting...");
    }

    var stopTrying = function() {
        navigator.geolocation.clearWatch(watchID);
        checkLocation(lastCheckedPosition);
    };

    var onError = function(error) {
        clearTimeout(timerID);
        navigator.geolocation.clearWatch(watchID);
        geolocationError(error);
    };

    var checkLocation = function(position) {
        lastCheckedPosition = position;
        locationEventCount = locationEventCount + 1;
        // We ignore the first event unless it's the only one received because some devices seem to send a cached
        // location even when maxaimumAge is set to zero
        if ((position.coords.accuracy <= options.desiredAccuracy) && (locationEventCount > 3)) {
            clearTimeout(timerID);
            navigator.geolocation.clearWatch(watchID);
            successCallback(position);
        } else {
            successCallback(position);
            onWait(position);
        }
    };

    watchID = navigator.geolocation.watchPosition(checkLocation, onError, options);
    timerID = setTimeout(stopTrying, options.maxWait); // Set a timeout that will abandon the location loop

</script>
@endsection
