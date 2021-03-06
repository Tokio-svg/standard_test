<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// トップページ
Route::get('/', function () {
  return view('index');
});

// お問い合わせ画面
Route::get('/contact', [ContactController::class, 'contact']);
Route::post('/contact', [ContactController::class, 'fix']);

// 確認画面
Route::post('/confirm', [ContactController::class, 'confirm']);

// お問い合わせ保存、サンクスページ遷移
Route::post('/create', [ContactController::class, 'create']);

// 管理システム
Route::get('/admin', [ContactController::class, 'admin']);
Route::get('/admin/search', [ContactController::class, 'search']);
Route::post('/delete', [ContactController::class, 'delete']);
