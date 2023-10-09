<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Models\Pengajuan;
use DB;
use Illuminate\Http\Request;

class PembaruanController extends Controller
{
    public function index()
    {
        $data['pembaruan'] = Pengajuan::where('tipe', 'pembaruan')->get();
        return view('admin.pembaruan.index', $data);
    }

    public function show(Request $request, int $id)
    {
        $data['pembaruan'] = Pengajuan::findOrFail($id);
        $data['keluarga'] = Keluarga::where('nik', $data['pembaruan']->nik)->first();
        return view('admin.pembaruan.show', $data);
    }

    public function verifikasi(Request $request, $id)
    {
        $pembaruan = Pengajuan::findOrFail($id);
        $keluarga = Keluarga::where('nik', $pembaruan->nik)->first();

        $newKeluarga = collect($pembaruan)->except(['tipe', 'created_at', 'updated_at']);
        if ($request->input('status') == 'terima') {
            return DB::transaction(function () use ($newKeluarga, $pembaruan) {
                if (Keluarga::where('nik', $newKeluarga['nik'])->update($newKeluarga->toArray()) > 0) {
                    $pembaruan->delete();
                    return redirect()->route('admin.pembaruan')->with(AlertFormatter::success('Data pemberuan berhasil diterima'));
                }
                return redirect()->back()->with(AlertFormatter::danger('Data pemberuan gagal diterima'));
            });
        }
        if($pembaruan->delete() > 0){
            return redirect()->route('admin.pembaruan')->with(AlertFormatter::success('Data pemberuan berhasil ditolak'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Data pemberuan gagal ditolak'));
    }
}
