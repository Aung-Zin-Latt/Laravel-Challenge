<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserTokenResource;

class LoginController extends Controller
{
    // I used Custom Request Validation to refactor the code
    public function login(LoginRequest $request): JsonResponse
    {
        // User Credentials
        $credentials = $request->validated();

        try {
            $user = User::where('email', $credentials['email'])->firstOrFail();
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Unable to find user with provided email.',
            ], 404);
        }
    
        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'The provided password is incorrect.'
            ]);
        }

        $token = $user->createToken('User-Token')->plainTextToken;
        // $resource = new UserTokenResource($user, $token); // Resources
        return response()->json(new UserTokenResource($user, $token))->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ]);
    }
}

    
