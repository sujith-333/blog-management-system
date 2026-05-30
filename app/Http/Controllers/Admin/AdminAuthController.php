<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('users')
                  ->where('email', $request->email)
                  ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['admin_logged_in' => true]);
            session(['admin_name'      => $user->name]);
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        session()->forget('admin_name');
        return redirect('/admin/login');
    }
}