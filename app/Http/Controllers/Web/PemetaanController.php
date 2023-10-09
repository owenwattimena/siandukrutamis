<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use Illuminate\Http\Request;

class PemetaanController extends Controller
{
    public function index()
    {
        $data['daftarKeluarga'] = Keluarga::all();
        return view('public.pemetaan.index', $data);
    }
}
