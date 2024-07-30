<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Str;

class UserController extends Controller
{
    public function change_password()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }
    public function MyAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "MY Account";
        if (Auth::user()->user_type == 2)
            return view('dosen.my_account', $data);
        else if (Auth::user()->user_type == 3) {
            $data['getClass'] = ClassModel::getClass();
            return view('student.my_account', $data);
        } else if (Auth::user()->user_type == 4)
            return view('ortu.my_account', $data);

        else if (Auth::user()->user_type == 1)
            return view('admin.my_account', $data);
    }
    public function UpdateMyAccountDosen(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $dosen =  User::getSingle($id);
        $dosen->name = trim($request->name);
        $dosen->email = trim($request->email);
        $dosen->material_status = trim($request->material_status);
        $dosen->qualification = trim($request->qualification);
        $dosen->gender = trim($request->gender);
        $dosen->permanent_address = trim($request->permanent_address);
        $dosen->address = trim($request->address);
        $dosen->work_experience = trim($request->work_experience);
        $dosen->mobile_number = trim($request->mobile_number);

        if (!empty($request->date_of_birth)) {
            $dosen->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->file('profile_pic'))) {
            if (!empty($dosen->getProfile())) {
                unlink('upload/profile/' . $dosen->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file =  $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $dosen->profile_pic = $filename;
        }

        $dosen->save();

        return redirect()->back()->with('success', "Account Berhasil Diupdate");
    }

    public function UpdateMyAccountOrtu(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $ortu =  User::getSingle($id);
        $ortu->name = trim($request->name);
        $ortu->email = trim($request->email);
        $ortu->occupation = trim($request->occupation);
        $ortu->gender = trim($request->gender);
        $ortu->address = trim($request->address);
        $ortu->mobile_number = trim($request->mobile_number);

        if (!empty($request->file('profile_pic'))) {
            if (!empty($ortu->getProfile())) {
                unlink('upload/profile/' . $ortu->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file =  $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $ortu->profile_pic = $filename;
        }

        $ortu->save();

        return redirect()->back()->with('success', "Account Berhasil Diupdate");
    }

    public function UpdateMyAccountAdmin(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $admin =  User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);


        $admin->save();

        return redirect()->back()->with('success', "Account Berhasil Diupdate");
    }

    public function UpdateMyAccountStudent(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $student =  User::getSingle($id);
        $student->name = trim($request->name);
        $student->email = trim($request->email);
        $student->caste = trim($request->caste);
        $student->height = trim($request->height);
        $student->gender = trim($request->gender);
        $student->weight = trim($request->weight);
        $student->address = trim($request->address);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);

        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->file('profile_pic'))) {
            if (!empty($student->getProfile())) {
                unlink('upload/profile/' . $student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file =  $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }

        $student->save();

        return redirect()->back()->with('success', "Account Berhasil Diupdate");
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
