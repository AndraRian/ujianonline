<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResponseFormatter;
use App\Models\User;

class RouteHandler extends Controller
{
    public function login()
    {
        $validator = \Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(400, $validator->errors());
        }

        $user = User::where('email', request()->email)->first();
        if (is_null($user)) {
            return ResponseFormatter::error(400, null, [
                'User tidak ditemukan'
            ]);
        }

        $userPassword = $user->password;
        if (\Hash::check(request()->password, $userPassword)) {
            $token = $user->createToken(config('app.name'))->plainTextToken;

            return ResponseFormatter::success([
                'token' => $token
            ]);
        }

        return ResponseFormatter::error(400, null, [
            'Password salah!'
        ]);
    }

    public function profile()
    {
        $user = request()->user()->only(['name', 'email']);

        return ResponseFormatter::success($user);
    }
}
