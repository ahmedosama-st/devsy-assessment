<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest as AdminLoginRequest;
use App\Http\Resources\PrivateUserResource;

class AuthController extends Controller
{
    /**
     * @return \App\Http\Resources\PrivateUserResource|\Illuminate\Http\JsonResponse
     */
    public function login(AdminLoginRequest $request)
    {
        if (! $token = auth('api')->attempt($request->validated())) {
            return response()->json([
                'errors' => [
                    'message' => ['Invalid credentials'],
                ],
            ], 422);
        }

        return (new PrivateUserResource(auth('api')->user()))
            ->additional([
                'meta' => [
                    'token' => $token,
                ],
            ]);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth('api')->logout();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
