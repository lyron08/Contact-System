<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [ContactController::class, 'index'])->name('contacts');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contact/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::patch('/contact/{id}/update', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contact/{id}/destroy', [ContactController::class, 'destroy'])->name('contacts.destroy');
});