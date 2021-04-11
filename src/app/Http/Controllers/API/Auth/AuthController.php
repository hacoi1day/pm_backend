<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function login(LoginRequest $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = $this->user->where('email', $request->email)->first();
                $user->token = $user->createToken('token')->accessToken;
                return response()->json($user, 200);
            }
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function me()
    {
        try {
            return response()->json(Auth::guard('api')->user());
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        try {
            if (Auth::guard('api')->check()) {
                $tokens = Auth::guard('api')->user()->tokens;
                foreach($tokens as $token) {
                    $token->revoke();
                }
                return response()->json([
                    'status' => 'success',
                    'message' => 'Logout successfully'
                ], 200);
            }
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
