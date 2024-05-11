<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class LoginApiController extends ApiController
{
    public function index(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $queryUser = User::where('email', $email)->first();
        if (empty($queryUser)) {
            return $this->sendError('Invalid credentials', [
                'email' => $email
            ], 400);
        }
        if (!Hash::check($password, $queryUser->password)) {
            return $this->sendError('Invalid credentials', [
                'email' => $email
            ], 400);
        }
        $token = $queryUser->createToken($queryUser->email);
        return $this->sendSuccess(
            [
                'user' => $queryUser,
                'token' => $token->plainTextToken
            ],
            'Login success'
        );
    }
}
