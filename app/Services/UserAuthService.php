<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;

class UserAuthService
{
    use ApiResponse;
    public function login($data)
    {
        $user = User::where('email', $data['email'])->first();
        try {

        if ($user) {
            if (Hash::check($data['password'], $user->password)) {

                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $user['token'] = $token;
                return ["data" => $user, 'success' => true];
            } else {
                return ["message" => "Password mismatch", 'success' => false];
            }
        } else {
            return ["message" =>'User does not exist', 'success' => false];

        }

        }catch (\Exception $exception){
            return ["message" =>$exception->getMessage(), 'success' => false];
        }
    }

    public function getData()
    {
        // TODO: Implement getData() method.
    }
}
