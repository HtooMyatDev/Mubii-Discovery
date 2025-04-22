<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function update(Request $request)
    {
        $validators = $this->checkValidation($request);
        if ($validators->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validators->errors(),
            ], 422);
        } else {
            $data       = $this->requestUserData($request);
            $oldProfile = User::select('profile')->where('id', $request->id)->first();

            if ($request->hasFile('profile')) {
                if ($oldProfile->profile != null) {
                    if (file_exists(public_path($oldProfile->profile))) {
                        logger('here1');
                        unlink(public_path($oldProfile->profile));
                    }
                }
                $path            = $request->file('profile')->store('profile_images', 'public');
                $imageURL        = Storage::url($path);
                $data['profile'] = $imageURL;

            } else {
                $data['profile'] = $oldProfile->profile;
            }

            User::where('id', $request->id)->update($data);
            $updatedData = User::find($request->id);

            return response()->json([
                'status'      => true,
                'updatedData' => $updatedData,
            ], 200);

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
        $validationRules = [
            'name'  => 'required',
            'email' => 'required|unique:users,email,' . $request->id,
        ];

        return Validator::make($request->all(), $validationRules);
    }
}
