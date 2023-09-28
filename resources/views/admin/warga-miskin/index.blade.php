@extends('templates.index')
@section('head')
<link href="{{ url('/') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection
@section('content')
<h3>Warga Miskin</h3>
<div class="card">
    <div class="card-body">

        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama KK</th>
                        <th>Jumlah Anggota</th>
                        <th>Pekerjaan</th>
                        <th>Gaji</th>
                        <th>Alamat</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($warga as $key => $item)
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama_kepala_keluarga }}</td>
                        <td>{{ $item->jumlah_anggota_keluarga }}</td>
                        <td>{{ $item->pekerjaan }}</td>
                        <td>{{ $item->gaji }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->email }}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ url('/') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
      } );
</script>
@endsection
