<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userToken = $request->header('USER-TOKEN');
        $apiToken = $request->header('API-TOKEN');

        if (!$userToken && !$apiToken) {
            return response()->json(['errors' => 'Missing Token'], 403);
        }

        $user = User::where([
            'api_token' => $apiToken,
            'user_token' => $userToken
        ])->first();

        if (!$user) {
            return response()->json(['errors' => 'Invalid Credentials'], 403);
        }

        Auth::login($user);
        return $next($request);
    }
}
