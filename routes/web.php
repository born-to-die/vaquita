<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MonthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('example-app')->group(function() {
    Route::get('/', [PlanController::class, 'index'])->name('plans');

    Route::get('/plans/create', [PlanController::class, 'create'])->name('plans-create');
    Route::post('/plans/store', [PlanController::class, 'store'])->name('plans-store');
    Route::get('/plans/{id}/edit', [PlanController::class, 'edit'])->name('plans-edit');
    Route::put('/plans/{id}/update', [PlanController::class, 'update'])->name('plans-update');
    Route::get('/plans/{id}/delete', [PlanController::class, 'delete'])->name('plans-delete');
    Route::put('/plans/{id}/complete', [PlanController::class, 'updateAsComplete'])->name('plans-complete');
    Route::delete('/plans/{id}/destroy', [PlanController::class, 'destroy'])->name('plans-destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories-create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories-store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories-edit');
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories-update');

    Route::get('/months', [MonthController::class, 'index'])->name('months');
    Route::get('/months/create', [MonthController::class, 'create'])->name('months-create');
    Route::post('/months/store', [MonthController::class, 'store']);
});

Route::prefix('example-app/api')->group(function() {
    Route::get('/', [PlanController::class, 'index']);
});
