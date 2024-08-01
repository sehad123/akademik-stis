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
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Facades\Image; // Assuming you're using Intervention Image package

class AuthController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } else if (Auth::user()->user_type == 2) {
                return redirect('dosen/dashboard');
            } else if (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            } else if (Auth::user()->user_type == 4) {
                return redirect('ortu/dashboard');
            }
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return response()->json(['status' => 'success', 'message' => 'Email and password correct. Please verify your face.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Email or password anda salah']);
        }
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
        Log::info('Stored image data: ' . $user->profile_pic);
        Log::info('Uploaded image data: ' . $image);

        if (empty($user->profile_pic)) {
            Log::error('No face data available for user: ' . $user->email);
            return response()->json(['status' => 'error', 'message' => 'No face data available for user'], 401);
        }

        // Kirim data ke API Python untuk perbandingan
        $response = Http::post('http://127.0.0.1:5000/compare_faces', [
            'stored_image' => $user->profile_pic,
            'uploaded_image' => $image,
        ]);

        if ($response->successful() && $response->json('result') === true) {
            Log::info('Face verification success');
            return response()->json(['status' => 'success', 'redirect_url' => url('/dashboard')]);
        }

        Log::error('Face verification failed');
        return response()->json(['status' => 'error', 'message' => 'Face verification failed'], 401);
    }

    // Example method for face recognition
    private function recognizeFace($storedImage, $uploadedImage)
    {
        // Implementasikan logika perbandingan wajah di sini
        // Mengembalikan true jika wajah cocok, sebaliknya false

        // Contoh dummy untuk ilustrasi
        return $storedImage === $uploadedImage; // Ganti dengan logika perbandingan sebenarnya
    }

    public function forgotpassword()
    {
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request)
    {
        $user  = User::where('email', $request->email)->first();
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('error', "Please check your email for password reset instructions.");
        } else {
            return redirect()->back()->with('error', "Email not found");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
