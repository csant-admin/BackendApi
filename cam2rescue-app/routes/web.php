<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\utility\UtilityFetchController;
use App\Http\Controllers\rescue\PetRescueController;
use App\Http\Controllers\report\RescueReportController;
use App\Http\Controllers\adoption\PetAdoptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/user-list', [UserController::class, 'getList']);
Route::get('/list-of-pets', [PetController::class, 'getPetList']);
Route::get('/barangay-list', [UtilityFetchController::class, 'getBarangayList']);
Route::get('/color-list', [UtilityFetchController::class, 'getColorList']);
Route::get('/injury-list', [UtilityFetchController::class, 'getInjuryList']);
Route::get('/pet-illness-list', [UtilityFetchController::class, 'getPetIllnessList']);
Route::get('/get-gender', [UtilityFetchController::class, 'getSexList']);
Route::get('/get-urgency', [UtilityFetchController::class, 'getUrgencyList']);
Route::get('/get-pet-detail', [PetAdoptionController::class, 'getPetDetail']);
// routes/web.php
Route::get('/test-token', [TestController::class, 'createToken']);
Route::get('/get-rescue-list', [PetRescueController::class, 'getRescueList']);
Route::get('generate-rescue-report/{rescueId}', [RescueReportController::class, 'generateRescueReport']);


Route::get('/check-auth', function () {
    $user = UserAuth::user();
    return $user ? $user : 'User not authenticated';
});

