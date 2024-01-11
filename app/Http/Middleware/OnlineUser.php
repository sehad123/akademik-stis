<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response; // Ganti Symfony\Component\HttpFoundation\Response dengan Illuminate\Http\Response
use Auth;
use Carbon\Carbon;
use Cache;

class OnlineUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) { // Menghapus !empty() dan mengubah pengecekan dengan Auth::check()
            $exp_time = Carbon::now()->addMinutes(1);
            Cache::put('OnlineUser' . Auth::user()->id, true, $exp_time);

            $getUserInfo = User::find(Auth::user()->id); // Menggunakan find() untuk mencari user berdasarkan ID
            $getUserInfo->updated_at = now(); // Menggunakan now() untuk mendapatkan waktu sekarang
            $getUserInfo->save();
        }

        return $next($request);
    }
}
