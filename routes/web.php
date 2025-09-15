<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/store', [TodoController::class, 'store'])->name('todos.store');
Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('todos.edit');
Route::put('/update/{id}', [TodoController::class, 'update'])->name('todos.update');
Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
Route::patch('/toggle/{id}', [TodoController::class, 'toggleStatus'])->name('todos.toggle');
