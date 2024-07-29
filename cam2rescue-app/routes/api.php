<?php

use App\Http\Controllers\Api\Dashboard\ManageUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostPetController;
use App\Http\Controllers\UserActivityLogsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/post-pet', [PostPetController::class, 'postPet']);
Route::post('/store-logs', [UserActivityLogsController::class, 'store']);
Route::post('/add-user', [UserController::class, 'createUser']);
Route::get('/user-list', [UserController::class, 'getList']);
Route::get('/list-of-pets', [PetController::class, 'getPetList']);

// Route::get('/user', [ManageUserController::class, 'getUserList']);
