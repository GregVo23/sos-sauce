<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Validation\LoginValidation;
use Illuminate\Support\Facades\Validator;
use App\Http\Validation\RegisterValidation;

class AuthenticationController extends Controller
{

    public function register(Request $request, RegisterValidation $validation)
    {
        $validator = Validator::make($request->all(), $validation->rules(), $validation->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $user = User::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'api_token' => Str::random(60)
        ]);
        $user->user_token = bcrypt($user->id);
        $user->save();

        return response()->json($user);
    }


    public function login(Request $request, LoginValidation $validation)
    {
        $validator = Validator::make($request->all(), $validation->rules(), $validation->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $email = $request->input('email');
            $user = User::where('email', $email)->firstOrFail();
            if ($user) {
                return response()->json($user);
            } else {
                return response()->json(['error' => 'Mauvais identifiant de connexion !'], 401);
            }
        } else {
            return response()->json(['error' => 'Mauvais identifiant de connexion !'], 401);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
    }

    public function user()
    {
        $user = auth()->user();

        return response()->json(['user' => $user]);
    }
}
