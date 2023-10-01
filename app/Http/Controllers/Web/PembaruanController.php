<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PembaruanController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        if ($request->query('nik')) {
            $nik = $request->query('nik');
            $data['warga'] = Keluarga::where('nik', $nik)->first();
        }
        return view('public.pembaruan.index', $data);
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
        $data['tipe'] = 'pembaruan';
        try {
            if (Pengajuan::create($data)) {
                return redirect()->route('pembaruan')->with(AlertFormatter::success('Berhasil melakukan pengajuan pembaruan data. Anda akan menerima email pemberitahuan apabila telah diverifikasi.'));
            }
            return redirect()->back()->with(AlertFormatter::danger('Gagal melakukan pengajuan pembaruan data. Pastikan data yang anda masukan sudah benar.'));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger('Gagal melakukan pengajuan pembaruan data. ' . $e->getMessage()));
        }
    }
}
