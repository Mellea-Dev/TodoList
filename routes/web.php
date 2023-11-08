<?php
use App\HTTP\Controllers\TodoController;
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



Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::get('todos/create', [TodoController::class, 'index'])->name('todos.create');

Route::post('todos/store', [TodoController::class, 'store'])->name('todos.store');
Route::patch('todos/update/{id}', [TodoController::class, 'update'])->name('todos.update');
Route::delete('todos/delete/{id}', [TodoController::class, 'delete'])->name('todos.delete');