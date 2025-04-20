<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function update(Request $request)
    {
        if ($this->checkValidation($request)) {
            return response()->json([
                'status' => 'Duplicate Email',
            ]);
        } else {
            $data       = $this->requestUserData($request);
            $oldProfile = User::select('profile')->where('id', $request->id)->first();

            if ($request->hasFile('profile')) {
                if ($oldProfile->profile != null) {
                    if (file_exists(public_path('user/profile/' . $oldProfile->profile))) {
                        unlink(public_path('user/profile/' . $oldProfile->profile));
                    }
                }
                $fileName = uniqid() . $request->file('profile')->getClientOriginalName();
                $request->file('profile')->move(public_path() . '/user/profile/', $fileName);
                $data['profile'] = $fileName;
            } else {
                $data['profile'] = $oldProfile->profile;
            }

            User::where('id', $request->id)->update($data);
            $updatedData = User::find($request->id);

            return response()->json([
                'status'      => 'Success',
                'updatedData' => $updatedData,
            ]);
        }
    }

    private function requestUserData($request)
    {
        return [
            'name'          => $request->name,
            'address'       => $request->address,
            'email'         => $request->email,
            'phone_number'  => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
        ];
    }

    private function checkValidation($request)
    {
        $emails = User::select('email')->where('id', '!=', $request->id)->get();

        for ($i = 0; $i < count($emails); $i++) {
            if ($request->email == $emails[$i]->email) {
                return true;
            }
        }
        return false;
    }
}
