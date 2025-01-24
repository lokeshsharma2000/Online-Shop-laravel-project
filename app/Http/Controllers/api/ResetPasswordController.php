<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Cache;


class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // Find the user by email
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            // Update the user's password
            $user->password = Hash::make($request->password);
            $user->save();
    
            return response()->json(['status' => 'Password reset successfully'], 200);
        }
    
        return response()->json(['email' => 'User not found'], 400);
    }
    
    public function sendResetLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        $user = User::where('email', $request->email)->first();
        $otp = rand(1111, 9999); 
        $user->otp = $otp;
        $user->save();
    
        Mail::to($user->email)->send(new PasswordResetMail($user->email, $otp));
    
        return response()->json(['status' => 'OTP sent successfully.'], 200);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && $user->otp == $request->otp) {
            $user->otp = null;
            $user->save();
    
            return response()->json(['status' => 'OTP verified successfully.'], 200);
        }
    
        return response()->json(['error' => 'Invalid or expired OTP.'], 400);
    }
}