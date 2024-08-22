<?php

namespace App\Http\Controllers;

use Str;
use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class AuthControllerHP extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['login', 'AuthLogin', 'forgotpassword', 'PostForgotPassword']);
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect($this->getRedirectUrl(Auth::user()->user_type));
        }
        return view('auth.loginhp');
    }

    public function getToken(Request $request)
    {
        return response()->json(['csrf_token' => csrf_token()]);
    }

    public function AuthLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = !empty($request->remember);

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil Login.',
                'redirect_url' => url($this->getRedirectUrl($user->user_type)),
                'user_type' => $user->user_type,  // Make sure user_type is included
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Email atau Password anda salah'], 401);
        }
    }

    private function getRedirectUrl($userType)
    {
        switch ($userType) {
            case 1:
                return 'admin/dashboard';
            case 2:
                return 'dosen/dashboard';
            case 3:
                return 'student/my_calendar';
            case 4:
                return 'ortu/dashboard';
            default:
                return 'login';
        }
    }

    public function forgotpassword()
    {
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', "Please check your email for password reset instructions.");
        } else {
            return redirect()->back()->with('error', "Email tidak ditemukan");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
