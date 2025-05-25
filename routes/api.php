<?php
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\CemeteryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlotPurchasesController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User
Route::post('/user', [UserController::class, 'create']);       
Route::get('/users', [UserController::class, 'getAll']);        
Route::get('/user/{id}', [UserController::class, 'getOne']);    
Route::put('/user/{id}', [UserController::class, 'update']);    
Route::delete('/user/{id}', [UserController::class, 'delete']);

// Plot Purchases
Route::post('/plot_purchase', [PlotPurchasesController::class, 'create']);
Route::get('/plot_purchases', [PlotPurchasesController::class, 'getAll']);
Route::get('/plot_purchase', [PlotPurchasesController::class, 'getOne']);
Route::put('/plot_purchase', [PlotPurchasesController::class, 'update']);
Route::delete('/plot_purchase', [PlotPurchasesController::class, 'delete']);

// FuneralOrder CRUD
Route::post('/funeral_order', [FuneralOrderController::class, 'createFuneralOrder']);
Route::get('/funeral_order', [FuneralOrderController::class, 'getAllFuneralOrders']);
Route::get('/funeral_order', [FuneralOrderController::class, 'getFuneralOrder']);
Route::put('/funeral_order', [FuneralOrderController::class, 'updateFuneralOrder']);
Route::delete('/funeral_order', [FuneralOrderController::class, 'deleteFuneralOrder']);

// MaintenanceOrder CRUD
Route::post('/maintenance_order', [MaintenanceOrderController::class, 'createMaintenanceOrder']);
Route::get('/maintenance_order', [MaintenanceOrderController::class, 'getAllMaintenanceOrders']);
Route::get('/maintenance_order', [MaintenanceOrderController::class, 'getMaintenanceOrder']);
Route::put('/maintenance_order', [MaintenanceOrderController::class, 'updateMaintenanceOrder']);
Route::delete('/maintenance_order', [MaintenanceOrderController::class, 'deleteMaintenanceOrder']);

// Funeral Service CRUD
Route::post('/service', [ServiceController::class, 'createservice']);
Route::get('/services', [ServiceController::class, 'getAllServices']);
Route::get('/service', [ServiceController::class, 'getService']);
Route::put('/service', [ServiceController::class, 'updateService']);
Route::delete('/service', [ServiceController::class, 'deleteService']);

// Cemetery CRUD
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