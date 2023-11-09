<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserAuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponse;
    public function login(UserLoginRequest $request, UserAuthService $auth){
        $authenticate = $auth->login($request->all());
        if ($authenticate['success']){
            return $this->success($authenticate['data']);
        }
        return $this->error($authenticate['message']);
    }

    public function register(UserRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            return $this->success($request, 201, 'User has been registered');
        }
        return $this->error('User can not been registered');
    }
}
