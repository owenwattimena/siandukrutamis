@extends('templates.index')

@section('content')
<h3>Dashboard</h3>
<div class="row">
    <div class="col-md-4">
        <div class="card radius-10 bg-gradient-cosmic">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <p class="mb-0 text-white">Total Warga Miskin</p>
                        <h4 class="my-1 text-white">4805</h4>
                        {{-- <p class="mb-0 font-13 text-white">+2.5% from last week</p> --}}
                    </div>
                    <div style="font-size: 50px"> <i class="bx bx-user-check text-white"></i> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card radius-10 bg-gradient-ohhappiness">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <p class="mb-0 text-white">Total Pengajuan</p>
                        <h4 class="my-1 text-white">{{ $pengajuan }}</h4>
                        {{-- <p class="mb-0 font-13 text-white">+2.5% from last week</p> --}}
                    </div>
                    <div style="font-size: 50px"> <i class="bx bx-mail-send text-white"></i> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card radius-10 bg-gradient-kyoto">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <p class="mb-0 text-white">Total Pembaruan</p>
                        <h4 class="my-1 text-white">{{ $pembaruan }}</h4>
                        {{-- <p class="mb-0 font-13 text-white">+2.5% from last week</p> --}}
                    </div>
                    <div style="font-size: 50px"> <i class="bx bx-message-square-edit text-white"></i> </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
