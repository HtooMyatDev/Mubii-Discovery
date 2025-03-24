<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function editProfile(Request $request)
    {
        $this->checkValidation($request);
        $user = $this->getData($request);
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
