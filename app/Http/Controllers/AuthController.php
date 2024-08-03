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

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('verify-face');
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return response()->json(['status' => 'success', 'message' => 'Berhasil Login. silahkan lakukan verifikasi wajah', 'user_id' => Auth::id()]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Email atau Password anda salah']);
        }
    }

    public function showVerifyFace()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        return view('auth.login');
    }

    public function verifyFace(Request $request)
    {
        Log::info('Received image for face verification');
        $request->validate([
            'image' => 'required|string'
        ]);

        $image = $request->input('image');
        $user = Auth::user();

        Log::info('Verifying face for user: ' . $user->email);

        if (empty($user->profile_pic)) {
            Log::error('No face data available for user: ' . $user->email);
            Auth::logout();
            return response()->json(['status' => 'error', 'message' => 'Wajah Pengguna Belum Terdaftar'], 401);
        }

        // Send data to the Python API for comparison
        $response = Http::post('http://127.0.0.1:5000/compare_faces', [
            'user_id' => $user->id,
            'uploaded_image' => $image,
        ]);

        Log::info('Response from Python API: ' . $response->body());

        if ($response->successful() && $response->json('status') === 'success') {
            Log::info('Face verification success');
            $redirectUrl = $this->getRedirectUrl($user->user_type);
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil Melakukan Verifikasi Wajah',
                'redirect_url' => url($redirectUrl)
            ]);
        }

        Log::error('Face verification failed');
        Auth::logout();
        return response()->json(['status' => 'error', 'message' => 'Gagal Melakukan Verifikasi Wajah'], 401);
    }

    private function getRedirectUrl($userType)
    {
        switch ($userType) {
            case 1:
                return 'admin/dashboard';
            case 2:
                return 'dosen/dashboard';
            case 3:
                return 'student/dashboard';
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
        $user  = User::where('email', $request->email)->first();
        if ($user) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('error', "Please check your email for password reset instructions.");
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
