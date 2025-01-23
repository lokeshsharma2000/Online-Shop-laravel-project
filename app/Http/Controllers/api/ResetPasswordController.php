<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['status' => __($status)], 200)
            : response()->json(['email' => __($status)], 500);
    }
    public function sendResetLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::where('email', $request->email)->first();
        Mail::to($user->email)->send(new PasswordResetMail($user));
        return response()->json(['status' => 'Password reset link sent successfully.'], 200);
    }
}