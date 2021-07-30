<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistController;

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

Route::get('/', [TodolistController::class, 'index'])->name('todolists.index');
Route::post('/todolists/store', [TodolistController::class, 'store'])->name('todolists.store');
Route::get('/todolists/{todolist}/edit', [TodolistController::class, 'edit'])->name('todolists.edit');
Route::put('/todolists/{todolist}', [TodolistController::class, 'update'])->name('todolists.update');
Route::put('/todolists/status/{id}', [TodolistController::class, 'updateStatus'])->name('todolists.updateStatus');
Route::delete('/todolists/{todolist}', [TodolistController::class, 'destroy'])->name('todolists.destroy');


