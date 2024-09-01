<?php

use App\Http\Controllers\Api\Dashboard\ManageUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostPetController;
use App\Http\Controllers\UserActivityLogsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\utility\UtilityFetchController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\rescue\PetRescueController;
use App\Http\Controllers\report\RescueReportController;

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
Route::post('/login',   [UserAuthController::class, 'login']);
Route::post('/logout',  [UserAuthController::class, 'logout']);

Route::post('/post-pet', [PostPetController::class, 'postPet']);
Route::post('/post-rescue', [PostPetController::class, 'postRescue']);
// Route::middleware('auth:sanctum')->post('/post-rescue', [PostPetController::class, 'postRescue']);


Route::post('/store-logs', [UserActivityLogsController::class, 'store']);

Route::post('/add-user', [UserController::class, 'createUser']);
Route::get('/user-list', [UserController::class, 'getList']);

Route::get('/list-of-pets', [PetController::class, 'getPetList']);


Route::get('/barangay-list',            [UtilityFetchController::class, 'getBarangayList']);
Route::get('/color-list',               [UtilityFetchController::class, 'getColorList']);
Route::get('/injury-list',              [UtilityFetchController::class, 'getInjuryList']);
Route::get('/pet-illness-list',         [UtilityFetchController::class, 'getPetIllnessList']);
Route::get('/get-gender',               [UtilityFetchController::class, 'getSexList']);
Route::get('/get-urgency',              [UtilityFetchController::class, 'getUrgencyList']);
Route::get('/get-statuses',             [UtilityFetchController::class, 'getStatuses']);
Route::get('/get-user-type',            [UtilityFetchController::class, 'getUserType']);
Route::get('/get-organization-type',    [UtilityFetchController::class, 'getOrganizationType']);
Route::get('/get-rescue-list',          [PetRescueController::class,    'getRescueList']);
Route::put('/approve-rescue/{id}',      [PetRescueController::class,    'approveRescue']);
Route::get('generate-rescue-report/{rescueId}', [RescueReportController::class, 'generateRescueReport']);

// Route::get('/user', [ManageUserController::class, 'getUserList']);RescueReportController
