<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// contact
Route::get('/contact', [ContactController::class, 'contact']);

// test
Route::get('/confirm', [ContactController::class, 'confirm']);
Route::get('/thanks', [ContactController::class, 'thanks']);
Route::get('/admin', [ContactController::class, 'admin']);
