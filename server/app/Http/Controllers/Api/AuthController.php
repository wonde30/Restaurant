<?php

namespace App\Http\Controllers\Api;

use App\Models\User;                                 // 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authrequest;
use App\Http\Resources\AuthResource;
class AuthController extends Controller
{
    public function login(Authrequest $request)
    {
        $user = User::where(
            'email',
            $request->email
        )->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
            if (!Hash::check($request->password, $user->password_hash)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }
        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Account disabled'
            ], 403);
        }
        $user->update([
            'last_login' => now()
        ]);
        $token = $user->createToken('hotel_token')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'login successfull',
            'token' => $token,
            'user' => new AuthResource($user)
        ]);
    }
}
