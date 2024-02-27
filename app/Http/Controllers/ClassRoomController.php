<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassRoomController extends Controller
{
    function get()
    {
        try {

            $data = ClassRoom::paginate();
            return response([
                'status' => true,
                'message' => 'success',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => null
            ], 500);
        }
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ], [
            'name.required' => 'Nama kelas tidak boleh kosong',
            'name.string' => 'Format kelas tidak valid'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => false,
                'message' => $validator->errors()->first(),
                'data' => null
            ], 401);
        }

        try {
            $data = [
                'class_name' => $request->name,
                'created_at' => now(),
                'updated_at' => now()
            ];

            $insert = ClassRoom::insert($data);
            if ($insert) {
                return response([
                    'status' => false,
                    'message' => 'success',
                    'data' => $data
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal menambahkan kelas baru',
                    'data' => null
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => 'Terjadi kesalahan!',
                'data' => null
            ], 500);
        }
    }

    function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ], [
            'name.required' => 'Nama kelas tidak boleh kosong',
            'name.string' => 'Format kelas tidak valid'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => false,
                'message' => $validator->errors()->first(),
                'data' => null
            ], 401);
        }

        try {
            $data = [
                'class_name' => $request->name,
                'updated_at' => now()
            ];

            $update = ClassRoom::where('id', $id)->update($data);
            if ($update) {
                return response([
                    'status' => true,
                    'message' => 'success',
                    'data' => $data
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal mengubah data',
                    'data' => null
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'data' => null
            ], 500);
        }
    }

    function destroy($id)
    {
        try {
            $delete = ClassRoom::where('id', $id)->delete();
            if ($delete) {
                return response([
                    'status' => false,
                    'message' => 'Berhasil menghapus data',
                    'data' => null
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal menghapus data',
                    'data' => null
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'data' => null
            ], 500);
        }
    }
}
