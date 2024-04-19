<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function update(UpdateProfileRequest $request)
    {
        $profile = Auth::user();
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->password = Hash::make($request->password);

        if ($profile->save()) {
            return $this->successResponse($profile, 'Usuario actualizado');;
        }
        return response()->json(['status' => 403, 'success' => false]);
    }
    

    public function user(Request $request)
    {
        $user = $request->user();

        return $this->successResponse($user, 'User found');
    }

    public function id(Request $request){
        $id = Auth::id();

        return $this->successResponse($id);
    }
}
