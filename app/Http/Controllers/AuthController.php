<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $userRepository;

    public function __construct(userRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request)
    {
        
        $user = $this->userRepository->registerUser($request);
        return response()->json(['user' => $user], 200);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['status' => 'success', 'token' => $token, 'user'=>$user], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    private function guard()
    {
        return Auth::guard();
    }

}
