<?php

// use App\Http\Controllers\Api\Dashboard\ManageUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\PostAdoption;
use App\Http\Controllers\Post\PostRescue;
use App\Http\Controllers\UserActivityLogsController;
use App\Http\Controllers\user\ManageUserController;
use App\Http\Controllers\Pets\ListOfPets;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\utility\UtilityFetchController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\rescue\PetRescueController;
use App\Http\Controllers\adoption\PetAdoptionController;
use App\Http\Controllers\report\RescueReportController;
use App\Http\Controllers\utility\AddNewUtilityController;

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

Route::controller(UserAuthController::class)->group(function() {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});

Route::controller(PostAdoption::class)->group(function() {
    Route::post('post-pet', 'postPet');
    Route::post('remove-post/{id}', 'removePost');
});

Route::controller(PostRescue::class)->group(function() {
    Route::post('post-rescue', 'postRescue');
    Route::post('remove-post/{id}', 'removePost');
});

Route::controller(ListOfPets::class)->group(function() {
    Route::get('list-of-pets', 'list');
});

Route::controller(UserActivityLogsController::class)->group(function() {
    Route::post('store-logs', 'store');
});

Route::controller(ManageUserController::class)->group(function() {
    Route::post('add-user', 'createUser');
    Route::get('user-list', 'getList');
    Route::get('get-user-details/{id}', 'getUserDetail');
    Route::put('update-user-status/{id}', 'changeStatus');
});

Route::controller(UtilityFetchController::class)->group(function(){
    Route::get('barangay-list', 'getBarangayList');
    Route::get('color-list', 'getColorList');
    Route::get('injury-list', 'getInjuryList');
    Route::get('pet-illness-list', 'getPetIllnessList');
    Route::get('get-gender', 'getSexList');
    Route::get('get-urgency', 'getUrgencyList');
    Route::get('get-statuses', 'getStatuses');
    Route::get('get-user-type', 'getUserType');
    Route::get('get-organization-type', 'getOrganizationType');
});

Route::controller(AddNewUtilityController::class)->group(function(){
    Route::post('add-new-illness', 'addNewIllness');
    Route::post('add-new-barangay', 'addNewBarangay');
    Route::post('add-new-color', 'addNewColor');
    Route::post('add-new-injury', 'addNewInjury');
    Route::post('add-new-urgency', 'addNewUrgency');
});

Route::controller(PetRescueController::class)->group(function() {
    Route::get('get-rescue-list', 'getRescueList');
    Route::put('approve-rescue/{id}', 'approveRescue');
    Route::get('generate-rescue-report/{id}', 'generateRescueReport');
});

Route::controller(PetAdoptionController::class)->group(function() {
    Route::get('get-pet-details/{id}', 'getPetDetail');
    Route::post('post-adoption', 'adoptPet');
});

