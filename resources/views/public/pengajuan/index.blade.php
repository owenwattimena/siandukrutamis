@extends('templates.index')
@section('head')
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection
@section('content')
    <h3>Pengajuan</h3>
    <div class="card">
        <div class="card-body">
            <form class="needs-validation" novalidate>
                <div class="row g-3">
                    <div class="col-sm-12">
                        <label for="inputNIK" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="inputNIK" placeholder="Masukan NIK" required>
                        <div class="invalid-feedback">Valid first name is required.</div>
                    </div>
                    <div class="col-sm-12">
                        <label for="inputNkk" class="form-label">Nama Kepala Keluarga</label>
                        <input type="text" class="form-control" id="inputNkk" placeholder="Masukan Nama Kepala Keluarga"
                            required>
                        <div class="invalid-feedback">Valid first name is required.</div>
                    </div>
                    <div class="col-sm-12">
                        <label for="inputJak" class="form-label">Jumlah Anggota Keluarga</label>
                        <input type="number" class="form-control" id="inputJak"
                            placeholder="Masukan Jumlah Anggota Keluarga" required>
                        <div class="invalid-feedback">Valid first name is required.</div>
                    </div>
                    <div class="col-sm-12">
                        <label for="inputPekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="inputPekerjaan" placeholder="Masukan Pekerjaan"
                            required>
                        <div class="invalid-feedback">Valid first name is required.</div>
                    </div>
                    <div class="col-sm-12">
                        <label for="inputGaji" class="form-label">Gaji/Bulan</label>
                        <input type="text" class="form-control" id="inputGaji" placeholder="Masukan Gaji/Bulan" required>
                        <div class="invalid-feedback">Valid first name is required.</div>
                    </div>
                    <div class="col-sm-12">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Masukan Email" required>
                        <div class="invalid-feedback">Valid first name is required.</div>
                    </div>
                    <div class="col-sm-12">
                        <label for="inputAlamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="inputAlamat" placeholder="Masukan Alamat" required></textarea>
                        <div class="invalid-feedback">Valid first name is required.</div>
                    </div>
                    <div class="col-sm-12">
                        <label for="inputmap" class="form-label">Pilih Lokasi Rumah di Peta</label>
                        <div id="map" class="map map-home" style="height: 500px; margin-top: 50px"></div>
                        <div class="invalid-feedback">Valid first name is required.</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var osmUrl = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
            osmAttrib = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            osm = L.tileLayer(osmUrl, {
                maxZoom: 18,
                attribution: osmAttrib
            });

        const successCallback = (position) => {
            console.log(position);
            console.log(position.coords.latitude);

            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15).addLayer(osm);

            // map.on('click', function(e) {
            //     var popLocation = e.latlng;
            //     map.removeLayer();
            //     L.marker(popLocation)
            //         .addTo(map)
            //         .bindPopup('A pretty CSS popup.<br />Easily customizable.')
            //         .openPopup();
            // });

            var theMarker = {};

            map.on('click', function(e) {
                lat = e.latlng.lat;
                lon = e.latlng.lng;

                console.log("You clicked the map at LAT: " + lat + " and LONG: " + lon);
                //Clear existing marker, 

                if (theMarker != undefined) {
                    map.removeLayer(theMarker);
                };

                //Add a marker to show where you clicked.
                theMarker = L.marker([lat, lon]).addTo(map);
            });

        };

        const errorCallback = (error) => {
            console.log(error);
        };

        const options = {
            enableHighAccuracy: true,
            timeout: 10000,
        };
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback, options);
    </script>
@endsection
