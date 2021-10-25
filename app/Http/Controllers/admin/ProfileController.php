<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function showProfile()
    {
        $id = auth()->user()->id;
        $data = User::where('id', $id)->first();

        return view('admin.profile.index')->with(['login_data' => $data]);
    }

    public function editProfile($id)
    {
        $data = User::where('id', $id)->first();
        return view('admin.profile.edit')->with(['data' => $data]);
    }

    public function updateProfile(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ],
        );

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        User::where('id', $id)->update($data);
        return redirect()->route('admin#profile')->with(['status' => 'Update Success']);
    }
    public function changePasswordView($id)
    {
        $data = User::where('id', $id)->first();
        return view('admin.profile.change_password')->with(['data' => $data]);
    }

    public function updatePassword(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'o_p' => 'required',
            'new_p' => 'required',
            'c_p' => 'required',
        ],
            [
                'o_p.required' => "Old Password is required",
                'new_p.required' => "New Password is required",
                'c_p.required' => "Confirm Password is required",
            ]
        );

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();

        }
        $data = User::where('id', $id)->first();
        $oldPassword = $request->o_p;
        $newPassword = $request->new_p;
        $confirmPassword = $request->c_p;
        $hashPassword = $data['password'];

        if (Hash::check($oldPassword, $hashPassword)) {
            if ($newPassword !== $confirmPassword) {
                return back()->with(['status' => 'New password and Confirm password are not same', 'color' => 'danger']);
            } else {
                if (strlen($newPassword) < 8 && strlen($confirmPassword) < 8) {
                    return back()->with(['status' => 'Password must be at least 8 character', 'color' => 'danger']);
                } else {
                    $hash = Hash::make($confirmPassword);
                    User::where('id', $id)->update([
                        'password' => $hash,
                    ]);
                    return back()->with(['status' => 'Password update is success', 'color' => 'success']);

                }
            }
        } else {
            return back()->with(['status' => 'Old password is wrong', 'color' => 'danger']);

        }
    }
}
