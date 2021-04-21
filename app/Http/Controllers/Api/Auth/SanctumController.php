<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class SanctumController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'message' => 'success',
            'data' => [
                'tokens' => $request->user()->tokens()->get()->makeHidden(['id', 'tokenable_type', 'tokenable_id', 'abilities', 'updated_at'])
            ]
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'message' => 'Created.',
            'token' => $user->createToken($request->device_name)->plainTextToken
        ], 201);
    }

    public function revoke(Request $request, $token = null)
    {
        if($token){
            $request->user()->tokens()->where('id', PersonalAccessToken::findToken($token)->id)->delete();
        }else{
            $request->user()->tokens()->delete();
        }

        return response()->json(['message' => 'success.']);
    }
}
