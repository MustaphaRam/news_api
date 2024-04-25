<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * register Function.
     */
    public function register(Request $request) {
        //
    }

    /**
     * login Function.
     */
    public function login(LoginRequest $request)
    {
        try{
            if(auth()->attempt($request->only(['email', 'password']))) {
                $user = User::find(auth()->id());

                $token = $user->createToken("Token_user")->plainTextToken;

                return response()->json([
                    "success" => true,
                    "status_message" => "User connecté",
                    "user" => $user,
                    "token" => $token
                ],200);

            } else {
                return response()->json([
                    "status_code" => 404,
                    "status_message" => "des Informations non valid.",
                ],404);
            }

        } catch (Exception $e) {
            return response()->json([
                "message_error" => "Internal Server Error",
                "error" => $e->getMessage(),
            ],500);
        }
    }

    /**
     * logout Function.
     */
    public function logout() {        
        dd('logout');
    }
}
