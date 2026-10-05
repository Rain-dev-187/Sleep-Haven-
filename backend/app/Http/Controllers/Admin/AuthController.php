<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $data['email'])->first();

        if ($admin && Hash::check($data['password'], $admin->password)) {
            session(['is_admin' => true, 'admin_name' => $admin->name]);

            return redirect()->route('admin.orders.index');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout()
    {
        session()->forget(['is_admin', 'admin_name']);

        return redirect()->route('admin.login');
    }
}
