<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Models\PsCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PSCategoriesController extends Controller
{


    function get()
    {
        try {

            $data = PsCategories::paginate();
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
            'category' => 'required|string'
        ], [
            'category.required' => 'Kategori tidak boleh kosong',
            'category.string' => 'Format kategori tidak valid'
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
                'name' => $request->category,
                'created_at' => now(),
                'updated_at' => now()
            ];

            $insert = PsCategories::insert($data);
            if ($insert) {
                return response([
                    'status' => false,
                    'message' => 'success',
                    'data' => $data
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal menambahkan kategori baru',
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
            'category' => 'required|string'
        ], [
            'category.required' => 'Kategori tidak boleh kosong',
            'category.string' => 'Format kategori tidak valid'
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
                'name' => $request->category,
                'updated_at' => now()
            ];

            $update = PsCategories::where('id', $id)->update($data);
            if ($update) {
                return response([
                    'status' => false,
                    'message' => 'success',
                    'data' => $data
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal mengubah kategori',
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
            $delete = PsCategories::where('id', $id)->delete();
            if ($delete) {
                return response([
                    'status' => true,
                    'message' => 'Berhasil menghapus data',
                    'data' => null
                ], 200);
            } else {
                return response([
                    'status' => true,
                    'message' => 'Gagal menghapus data',
                    'data' => null
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'status' => true,
                'message' => 'Terjadi kesalahan',
                'data' => null
            ], 500);
        }
    }
}
