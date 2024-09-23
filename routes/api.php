<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\GovernmentServiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\IndividualServiceController;
use App\Http\Controllers\CompaniesServiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;



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





Route::get('/statistics', [StatisticsController::class, 'index']);
Route::post('/statistics', [StatisticsController::class, 'store']);





Route::get('/government-services', [GovernmentServiceController::class, 'index']);
Route::post('/government-services', [GovernmentServiceController::class, 'store']);
Route::put('/government-services/{id}', [GovernmentServiceController::class, 'update']);
Route::delete('/government-services/{id}', [GovernmentServiceController::class, 'destroy']);



Route::get('/clients', [ClientController::class, 'index']);
Route::post('/clients', [ClientController::class, 'store']);
Route::put('/clients/{id}', [ClientController::class, 'update']);
Route::delete('/clients/{id}', [ClientController::class, 'destroy']);


Route::get('/individual-services', [IndividualServiceController::class, 'index']);
Route::post('/individual-services', [IndividualServiceController::class, 'store']);
Route::put('/individual-services/{id}', [IndividualServiceController::class, 'update']);
Route::delete('/individual-services/{id}', [IndividualServiceController::class, 'destroy']);


Route::get('/companies-services', [CompaniesServiceController::class, 'index']);
Route::post('/companies-services', [CompaniesServiceController::class, 'store']);
Route::put('/companies-services/{id}', [CompaniesServiceController::class, 'update']);
Route::delete('/companies-services/{id}', [CompaniesServiceController::class, 'destroy']);




Route::get('/services', [ServiceController::class, 'index']);
Route::post('/services', [ServiceController::class, 'store']);
Route::put('/services/{id}', [ServiceController::class, 'update']);
Route::delete('/services/{id}', [ServiceController::class, 'destroy']);




Route::get('/blogs', [BlogController::class, 'index']);
Route::post('/blogs', [BlogController::class, 'store']);
Route::put('/blogs/{id}', [BlogController::class, 'update']);
Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);
