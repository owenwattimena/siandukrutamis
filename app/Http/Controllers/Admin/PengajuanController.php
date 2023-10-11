<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Mail\Notification;
use App\Models\Keluarga;
use App\Models\Pengajuan;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PengajuanController extends Controller
{
    public function index()
    {
        $data['pengajuan'] = Pengajuan::where('tipe', 'pengajuan')->get();
        return view('admin.pengajuan.index', $data);
    }

    public function show(Request $request, $id)
    {
        $data['pengajuan'] = Pengajuan::findOrFail($id);
        return view('admin.pengajuan.show', $data);
    }

    public function status(Request $request, $id)
    {
        if ($request->input('status') == 'terima') {
            return DB::transaction(function () use ($id) {
                $pengajuan = Pengajuan::where('id', $id)->get()->first();
                $data = [
                    'title' => 'Pengajuan Diterima',
                    'body' => 'Hi, ' . $pengajuan->nama_kepala_keluarga . '. pengajuan anda telah diterima.'
                ];
                Mail::to($pengajuan->email)->send(new Notification($data));
                return;
                Keluarga::create(collect($pengajuan->toArray())->except(['id', 'created_at', 'updated_at'])->all());

                if (Pengajuan::destroy($pengajuan->id) > 0) {

                    $data = [
                        'title' => 'Pengajuan Diterima',
                        'body' => 'Hi, ' . $pengajuan->nama_kepala_keluarga . '. pengajuan anda telah diterima.'
                    ];
                    Mail::to($pengajuan->email)->send(new Notification($data));
                    return redirect()->route('admin.pengajuan')->with(AlertFormatter::success('Data berhasil di terima'));
                }
                return redirect()->back()->with(AlertFormatter::danger('Data gagal di terima'));
            });
        } else if ($request->input('status') == 'tolak') {
            $pengajuan = Pengajuan::where('id', $id)->get()->first();
            if (Pengajuan::destroy($pengajuan->id) > 0)
                return redirect()->route('admin.pengajuan')->with(AlertFormatter::success('Data berhasil di tolak'));
            return redirect()->back()->with(AlertFormatter::danger('Data gagal di tolak'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Gagal melakukan aksi'));
    }
}
