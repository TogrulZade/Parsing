<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KontaktHomeController;
use App\Http\Controllers\HomeController;


Route::get('/', [IndexController::class, 'index']);
Route::get('/bakuelectronics', [IndexController::class, 'getFromCategory']);
Route::get('item', [IndexController::class, 'items']);
Route::get('wt', [IndexController::class, 'wt']);

Route::get('kontakthome', [KontaktHomeController::class, 'index']);
Route::get('maxi', [IndexController::class, 'maxi']);

Route::get('getFrom', [IndexController::class, 'getFrom']);
Route::post('getFrom', [IndexController::class, 'getFromAction']);

Route::get('fromKontakt', [KontaktHomeController::class, 'getFrom']);
Route::post('fromKontakt', [KontaktHomeController::class, 'getFromAction']);

Route::get('automation', [IndexController::class, 'automation']);
Route::post('automation', [IndexController::class, 'automationAction']);

Route::get('web', [IndexController::class, 'web']);
Route::get('text', [IndexController::class, 'text']);

Route::get('home', [HomeController::class, 'index']);
Route::get('match/{id}', [HomeController::class, 'match']);
Route::get('m', [HomeController::class, 'm']);
Route::get('word', [IndexController::class, 'word']);
Route::get('turbo', [IndexController::class, 'turbo']);


Route::group(['prefix'=>'kontakt'], function(){
    Route::get('detail/{url}', [KontaktHomeController::class, "detail"]);
});