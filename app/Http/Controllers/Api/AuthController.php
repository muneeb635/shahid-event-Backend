<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LoginResource;

class AuthController extends Controller
{
    public function loginUser(Request $request, User $user)
    {
        try {
            if (Auth::attempt($request->all())) {
                $user = Auth::user();
                $user['jwt'] =  auth()->user()->createToken('Api Tokken')->plainTextToken;
                return response()->json([
                    'status' => 200,
                    'message' => 'Login Successfully',
                    new LoginResource($user),
                ]);
            }
            return response()->json(['status' => 401, 'message' => 'email or password wrong']);
        } catch (\Throwable $e) {
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
}
