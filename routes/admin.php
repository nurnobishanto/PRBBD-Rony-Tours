<?php

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SupportDepartmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PassengerController;
use App\Http\Controllers\FrontEnd\SubscriberController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('admin.')->prefix('admin')->middleware('auth:admin')->group(function (){
    Route::get('/',[Dashboard::class,'index'])->name('dashboard');
    Route::get('/subscribers',[SubscriberController::class,'index'])->name('subscribers');
    Route::get('/settings',[SettingsController::class,'index'])->middleware('permission:settings.manage')->name('settings');
    Route::post('/settings/general-settings',[SettingsController::class,'general_settings'])->middleware('permission:settings.manage')->name('general_settings');
    Route::post('/settings/flyhub-settings',[SettingsController::class,'flyhub_settings'])->middleware('permission:settings.manage')->name('flyhub_settings');
    Route::resource('/roles',RoleController::class)->middleware('permission:roles.manage');
    Route::resource('/permissions',PermissionController::class)->middleware('permission:permission.manage');
    Route::resource('/departments',SupportDepartmentController::class)->middleware('permission:departments.manage');

    Route::post('/settings/general-settings',[SettingsController::class,'general_settings'])->middleware('permission:settings.manage')->name('general_settings');

    Route::controller(SliderController::class)
        ->prefix('sliders')
        ->as('sliders.')
        // ->middleware('permission:slider.manage')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{slider}', 'edit')->name('edit');
            Route::post('update/{slider}', 'update')->name('update');
            Route::delete('destroy/{slider}', 'destroy')->name('destroy');
            Route::get('trashed', 'trashed')->name('trashed');
            Route::get('restore/{id}', 'restore')->name('restore');
        });

    Route::controller(PassengerController::class)
        ->prefix('passengers')
        ->as('passengers.')
        // ->middleware('permission:passenger.manage')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{passenger}', 'edit')->name('edit');
            Route::post('update/{passenger}', 'update')->name('update');
            Route::delete('destroy/{passenger}', 'destroy')->name('destroy');
            Route::get('trashed', 'trashed')->name('trashed');
            Route::get('restore/{id}', 'restore')->name('restore');
        });

    Route::controller(PageController::class)
        ->prefix('pages')
        ->as('pages.')
        // ->middleware('permission:passenger.manage')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{passenger}', 'edit')->name('edit');
            Route::post('update/{passenger}', 'update')->name('update');
            Route::delete('destroy/{passenger}', 'destroy')->name('destroy');
            Route::get('trashed', 'trashed')->name('trashed');
            Route::get('restore/{id}', 'restore')->name('restore');
        });
});
