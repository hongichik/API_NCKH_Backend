<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admins;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // return 'oke';
        $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:8|max:30'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::guard('admin')->attempt($credentials)) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Tài khoản hoặc mật khẩu sai'
            ]);
        }

        $Admins = Admins::where('email', $request->email)->first();

        if (!Hash::check($request->password, $Admins->password, [])) {
            throw new \Exception('đăng nhập thất bại');
        }

        $tokenResult = $Admins->createToken('authToken')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
        ]);
        
    }
}
