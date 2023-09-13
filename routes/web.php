<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KontaktHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\RetailController;
use App\Http\Controllers\DermanController;
use App\Http\Controllers\SeleniumController;


Route::get('/', [SiteController::class, 'show']);
Route::get('item', [IndexController::class, 'items']);

Route::get('getFrom', [IndexController::class, 'getFrom']);
Route::post('getFrom', [IndexController::class, 'getFromAction']);

Route::get('automation', [IndexController::class, 'automation']);
Route::post('automation', [IndexController::class, 'automationAction']);

Route::get('web', [IndexController::class, 'web']);
Route::get('text', [IndexController::class, 'text']);

Route::get('home', [HomeController::class, 'index']);
Route::get('match/{id}', [HomeController::class, 'match']);
Route::get('m', [HomeController::class, 'm']);
Route::get('word', [IndexController::class, 'word']);
Route::get('turbo', [IndexController::class, 'turbo']);


Route::group(['prefix' => 'kontakt'], function () {
    Route::get('detail/{url}', [KontaktHomeController::class, "detail"]);
});

Route::group(
    ['prefix' => 'settings'],
    function () {

        Route::get('/', [SettingController::class, 'index'])->name("settings");
        Route::get('addsite', [SettingController::class, 'addsite']);
        Route::post('addsite', [SettingController::class, 'addsiteAction']);
    }
);

Route::group(['prefix' => 'site'], function () {
    Route::get('/', [SiteController::class, "show"])->name("sites");
    Route::get('getdata/{id}', [SiteController::class, "getdata"]);
    Route::post('getdata/{id}', [SiteController::class, "getdataAction"]);
    Route::get('tafsir/{id}', [SiteController::class, "tafsir"]);
    Route::get('addlink/{id}', [SiteController::class, "addlink"]);
    Route::post('addlink/{id}', [SiteController::class, "addlinkAction"])->name("addlinkAction");
    Route::get('{id}/links/', [SiteController::class, "getlinks"])->name("links");
    Route::get('edit/{id}', [SiteController::class, "edit"])->name("site.edit");
    Route::get('delete/link/{id}', [SiteController::class, "deleteLink"])->name("link.delete");
    Route::get('delete/site/{id}', [SiteController::class, "deleteSite"])->name("site.delete");
    Route::post('edit/{id}', [SiteController::class, "editAction"])->name("site.edit.action");
    Route::get('wolt', [SiteController::class, "wolt"]);
    Route::get('curl', [SiteController::class, "curl"]);
});

Route::group(['prefix' => 'retail'], function () {
    Route::get('/', [RetailController::class, "show"])->name("retails");
    Route::get('/create', [RetailController::class, "create"])->name("retail.create");
    Route::post('/create', [RetailController::class, "createAction"])->name("retail.create.action");
    Route::get('/download', [RetailController::class, "download"])->name("retail.download");
});

Route::get('/derman/export', [DermanController::class, "export"])->name("derman.export");
Route::get('/selenium', [SeleniumController::class, "scrapePharmastore"])->name("selenium.scrapePharmastore");
