<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use Illuminate\Http\Request;

class KeluargaController extends Controller
{
    public function index()
    {
        $data['warga'] = Keluarga::all();
        return view('admin.warga-miskin.index', $data);
    }
}
