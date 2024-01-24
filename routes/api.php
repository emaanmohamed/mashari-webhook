<?php

use App\Http\Controllers\Api\Security\SecurityController;
use App\Http\Controllers\CountryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(CountryController::class)->prefix('country')->group(function () {
    Route::get('get', 'GetAllCountries');
    Route::post('update', 'UpdateCountry');
    Route::post('store', 'StoreCountry');
    Route::post('delete', 'DeleteCountry');
});

Route::post('Get/Token', [SecurityController::class, 'requestToken']);

Route::group(['middleware' => ['client']], function () {
    Route::get('countries/get-list/{callbackUrl?}', [CountryController::class, 'getCountries']);
});
