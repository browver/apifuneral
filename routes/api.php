<?php
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\CemeteryController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Funeral Service CRUD
Route::post('/service', [ServiceController::class, 'createservice']);
Route::get('/services', [ServiceController::class, 'getAllServices']);
Route::get('/service', [ServiceController::class, 'getService']);
Route::put('/service', [ServiceController::class, 'updateService']);
Route::delete('/service', [ServiceController::class, 'deleteService']);

// Funeral Cemetery CRUD
Route::post('/cemetery', [CemeteryController::class, 'createCemetery']);
Route::get('/cemeteries', [CemeteryController::class, 'getAllCemeteries']);
Route::get('/cemetery', [CemeteryController::class, 'getCemetery']);
Route::put('/cemetery', [CemeteryController::class, 'updateCemetery']);
Route::delete('/cemetery', [CemeteryController::class, 'deleteCemetery']);

// Maintenance Service CRUD
Route::post('/maintenance', [MaintenanceController::class, 'createMaintenance']);
Route::get('/maintenances', [MaintenanceController::class, 'getAllMaintenances']);
Route::get('/maintenance', [MaintenanceController::class, 'getMaintenance']);
Route::put('/maintenance', [MaintenanceController::class, 'updateMaintenance']);
Route::delete('/maintenance', [MaintenanceController::class, 'deleteMaintenance']);

// Funeral Plot CRUD
Route::post('/plot', [PlotController::class, 'createPlot']);
Route::get('/plots', [PlotController::class, 'getAllPlots']);
Route::get('/plot', [PlotController::class, 'getPlot']);
Route::put('/plot', [PlotController::class, 'updatePlot']);
Route::delete('/plot', [PlotController::class, 'deletePlot']);



// sign-up
Route::post('/signup', [AuthController::class, 'signup']);
// login
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

});