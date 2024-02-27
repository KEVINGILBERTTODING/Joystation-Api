<?php

use App\Http\Controllers\api\admin\PSCategoriesController;
use App\Http\Controllers\api\user\auth\UserAuthController;
use App\Http\Controllers\ClassRoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [UserAuthController::class, 'login'])->name('login');
Route::prefix('/auth')->group(function () {
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);
});

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('detail', [UserAuthController::class, 'index']);
});

Route::prefix('/admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/playstation/categories', [PSCategoriesController::class, 'get']);
    Route::post('/playstation/categories/store', [PSCategoriesController::class, 'store']);
    Route::post('/playstation/categories/update/{id}', [PSCategoriesController::class, 'update']);
    Route::delete('/playstation/categories/destroy/{id}', [PSCategoriesController::class, 'destroy']);

    // class room
    Route::get('class_rooms', [ClassRoomController::class, 'get']);
    Route::post('class_rooms/store', [ClassRoomController::class, 'store']);
    Route::post('class_rooms/update/{id}', [ClassRoomController::class, 'update']);
    Route::delete('class_rooms/destroy/{id}', [ClassRoomController::class, 'destroy']);
});
