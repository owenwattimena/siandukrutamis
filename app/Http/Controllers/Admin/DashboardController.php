<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['pengajuan'] = Pengajuan::where('tipe', 'pengajuan')->count();
        $data['pembaruan'] = Pengajuan::where('tipe', 'pembaruan')->count();
        return view('admin.dashboard.index', $data);
    }
}
