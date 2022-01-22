<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectedVerify
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

        if ($userToken && $apiToken) {
            $user = User::where([
                'api_token' => $apiToken,
                'user_token' => $userToken
            ])->first();
            if ($user) {
                Auth::login($user);
            }
        }
        return $next($request);
    }
}
