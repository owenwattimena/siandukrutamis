<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('public.pengajuan.index');
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required',
            'nama_kepala_keluarga' => 'required',
            'jumlah_anggota_keluarga' => 'required',
            'pekerjaan' => 'required',
            'gaji' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if(Pengajuan::create($data))
        {
            return redirect()->back()->with(AlertFormatter::success('Berhasil melakukan pengajuan. Anda akan menerima email pemberitahuan apabila telah diverifikasi.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Gagal melakukan pengajuan. Pastikan data yang anda masukan sudah benar.'));
    }
}
