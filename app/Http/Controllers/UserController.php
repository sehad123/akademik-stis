<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;

class UserController extends Controller
{
    public function change_password()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }
    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            if ($request->new_password === $request->confirm_password) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->back()->with('success', 'Password anda berhasil diperbarui');
            } else {
                return redirect()->back()->with('error', 'Confirm password harus sama dengan new password');
            }
        } else {
            return redirect()->back()->with('error', 'Old password anda salah');
        }
    }
}
