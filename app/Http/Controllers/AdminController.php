<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.home");
    }

    public function profile()
    {
        return view("admin.profile.index");
    }

    public function changePasswordPage()
    {
        return view('admin.profile.changePassword');
    }

    public function changePassword(Request $request)
    {
        $this->checkValidation($request);
        if (Hash::check($request->oldPassword, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword),
            ]);

            Alert::success("Password Changed", "Password has been changed successfully!");
            return to_route('admin#profile');
        }

        Alert::error('Password Change', 'Password has not been changed, check your old password!');

        return back();
    }
    public function editProfile(Request $request)
    {
        $this->checkValidation($request);
        $user = $this->getData($request);

        if ($request->hasFile('profile')) {
            if (Auth::user()->profile != null) {
                if (file_exists(public_path('admin/profile/' . Auth::user()->profile))) {
                    unlink(public_path('admin/profile/' . Auth::user()->profile));
                }
            }
            $filename = uniqid() . $request->file('profile')->getClientOriginalName();
            $request->file('profile')->move(public_path() . '/admin/profile/', $filename);
            $user['profile'] = $filename;
        } else {
            $user['profile'] = Auth::user()->profile;
        }

        User::where('id', Auth::user()->id)->update($user);
        return to_route('admin#profile');
    }
    // Get User Data
    private function getData($request)
    {
        if ($request->status == "personal") {
            $name = implode(" ", [$request->firstName, $request->lastName]);
            $user = [
                'name'          => $name,
                'email'         => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'phone_number'  => $request->phone_number,
            ];
        } else {
            $user = [
                'address'     => $request->address,
                'city'        => $request->city,
                'postal_code' => $request->postal_code];
        }

        return $user;
    }

    // Validation
    private function checkValidation($request)
    {
        if ($request->status == 'personal') {
            $validationRules = [
                'firstName'     => 'required',
                'lastName'      => 'required',
                'email'         => ['required', 'unique:users,email,' . Auth::user()->id],
                'phone_number'  => 'required',
                'date_of_birth' => 'required',
                'profile'       => "mimes:jpg,png,psd,jpeg,webp,svg",
            ];
        } else if ($request->status == "password") {
            $validationRules = [
                'oldPassword'             => ['required'],
                'newPassword'             => ['required', 'same:newPasswordConfirmation'],
                'newPasswordConfirmation' => ['required', 'same:newPassword'],
            ];
        } else {
            $validationRules = [
                'address'     => 'required',
                'city'        => 'required',
                'postal_code' => 'required',
            ];
        }

        $request->validate($validationRules);
    }
}
