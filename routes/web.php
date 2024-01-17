<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TaskController::class, 'view'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/add-task', [TaskController::class, 'addTask'])->name('add-Task');
    Route::patch('/edit-task/{id}', [TaskController::class, 'updateTask'])->name('edit-Task');
    Route::delete('/destroy/{id}', [TaskController::class, 'destroy'])->name('delete-Task');
    Route::get('/history', [TaskController::class, 'history'])->name('history');
    Route::get('/stat/{type}', [TaskController::class, 'stat'])->name('stat');
    Route::get('/budget', [TaskController::class, 'budget'])->name('budget');
    Route::get('/budget/{mon}/{year}', [TaskController::class, 'budgetapi'])->name('budgetA');
    
});

require __DIR__.'/auth.php';
