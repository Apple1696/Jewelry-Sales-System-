<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="Đăng nhập",
     *     description="API đăng nhập",
     *     tags={"1. Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="phone_number",
     *                 type="string",
     *                 description="Số điện thoại đăng nhập",
     *                 example="0960656945"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 description="Mật khẩu đăng nhập",
     *                 example="password"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Đăng nhập thành công",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Đăng nhập thành công"
     *             ),      
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 description="Token xác thực",
     *                 example="plain-text-token"
     *             ),
     *             @OA\Property(
     *                 property="token_type",
     *                 type="string",
     *                 description="Loại token: Bearer",
     *                 example="Bearer"
     *             ),
     *             @OA\Property(
     *                 property="expires_at",
     *                 type="string",
     *                 description="Thời gian hết hạn của token: yyyy-mm-dd hh:mm:ss",
     *                 example="2023-03-06 00:00:00"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Đăng nhập thất bại",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="error"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Thông tin đăng nhập không chính xác"
     *             ),    
     *         ),
     *     ),
     * )
     */

    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required', 'regex:/^[0-9]{10,11}$/',
            'password' => 'required',
        ]);

        $credentials = $request->only('phone_number', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $expires_at = now()->addDays(7)->toDateTimeString(); // Thời gian hết hạn là 7 ngày

            return response()->json([
                'status' => 'success',
                'message' => 'Đăng nhập thành công',
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $expires_at,
            ]);
        }
        
        return response()->json([
            'status' => 'error',
            'message' => 'Thông tin đăng nhập không chính xác',
        ], 401);
    }

    public function register(Request $request)
    {
        // Kiểm tra xem user hiện tại có quyền admin hay không
        // if (!$request->user()->isAdmin()) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required', 'regex:/^[0-9]{10,11}$/',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->phone_number = $request->input('phone_number');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;
        $expires_at = now()->addDays(7)->toDateTimeString();
        
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => $expires_at,
        ]);
    }

}
