<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($data))
        {
            return redirect()->intended('/admin/dashboard');
        }
        return redirect()->back()->with(AlertFormatter::danger('Username atau password salah.'));
    }
}

