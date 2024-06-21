<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $token = auth()->user()->createToken('access_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }


    public function destroy(Request $request): JsonResponse
    {
       $request->user()->currentAccessToken()->delete();

       return response()->json([
        'message'=> 'Token receked successfully'
       ]);

    }
}
