<?php

namespace App\Http\Controllers\api\user\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            'status' => true,
            'message' => 'It works!'
        ], 200);
    }

    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|string'
        ], [
            'required' => ':attribute tidak boleh kosong!',
            'email' => ':attribute email tidak valid!',
            'string' => ':attribute hanya boleh berupa huruf dan angka!',
            'min' => ':attribute tidak boleh kurang dari 8 karakter!',
            'exists' => ':attribute belum terdaftar!'
        ], [
            'email' => 'Email',
            'password' => 'Password'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => false,
                'message' => $validator->errors()->first(),
                'data' => null
            ], 401);
        }
        try {
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                $user = User::where('email', $request->email)->firstOrFail();
                return response([
                    'status' => true,
                    'message' => 'Selamat datang ' . $user->name,
                    'data' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'token' => $user->createToken('joystation-token')->plainTextToken
                    ]
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Email atau password salah!',
                    'data' => null
                ], 401);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ], 500);
        }
    }

    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric',
            'password' => 'required|string|min:8'
        ], [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute hanya boleh berupa huruf dan angka',
            'email' => ':attribute format tidak valid',
            'unique' => ':attribute telah terdaftar',
            'numeric' => ':attribute hanya boleh berupa angka',
            'min' => ':attribute tidak boleh lebih dari 8 karakter'

        ], [
            'name' => 'Nama',
            'email' => 'Email',
            'phone_number' => 'No Handphone',
            'password' => 'Password'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => false,
                'message' => $validator->errors()->first(),
                'data' => null
            ], 401);
        }

        try {
            $data  = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => 1,
                'password' => Hash::make($request->password),
                'is_active' => true,
                'phone_number' => $request->phone_number,
                'email_verified_at' => now(),
            ];

            $user = User::create($data);
            if ($user) {
                return response([
                    'status' => true,
                    'message' => 'success',
                    'data' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'token' => $user->createToken('joystation-token')->plainTextToken
                    ]
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Terjadi kesalahan!',
                    'data' => null
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null

            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
