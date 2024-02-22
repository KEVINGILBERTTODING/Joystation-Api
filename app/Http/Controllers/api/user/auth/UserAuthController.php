<?php

namespace App\Http\Controllers\api\user\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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

    function login()
    {
    }

    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric',
            'password' => 'required|string|min:8'
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