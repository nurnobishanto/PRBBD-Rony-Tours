<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BankController;
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
use App\Http\Controllers\FrontEnd\UserBalance;
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

// Route::name('admin.')->prefix('admin')->middleware('auth:admin')->group(function (){
Route::name('admin.')->prefix('admin')->group(function (){
    Route::get('/',[Dashboard::class,'index'])->name('dashboard');
    Route::get('/subscribers',[SubscriberController::class,'index'])->name('subscribers');
    Route::get('/deposits',[UserBalance::class,'index'])->name('deposits');
    Route::get('/deposit/{id}/approve',[UserBalance::class,'deposit_approve'])->name('deposit_approve');
    Route::get('/deposit/{id}/reject',[UserBalance::class,'deposit_reject'])->name('deposit_reject');

    Route::get('/page/about',function () {return view('admin.page.about');});
    Route::get('/page/privacy',function () {return view('admin.page.privacy');});
    Route::get('/page/terms',function () {return view('admin.page.terms');});
    Route::get('/page/testimonials',function () {return view('admin.page.testimonials');});
    Route::post('/page/update',[SettingsController::class,'update_custom_page'])->name('update_custom_page');

    Route::get('/settings/general',[SettingsController::class,'general_settings'])->middleware('permission:settings.manage')->name('general_settings');
    Route::post('/settings/general/update',[SettingsController::class,'update_general_settings'])->middleware('permission:settings.manage')->name('update_general_settings');

    Route::post('/settings/flyhub-settings',[SettingsController::class,'flyhub_settings'])->middleware('permission:settings.manage')->name('flyhub_settings');

    Route::resource('/roles',RoleController::class)->middleware('permission:roles.manage');
    Route::resource('/permissions',PermissionController::class)->middleware('permission:permission.manage');
    Route::resource('/departments',SupportDepartmentController::class)->middleware('permission:departments.manage');
    Route::get('/supports',[SubscriberController::class,'admin_supports'])->name('supports');
    Route::get('/support/{id}/chat',[SubscriberController::class,'admin_support_chat'])->name('support_chat');
    Route::get('/support/{id}/end',[SubscriberController::class,'admin_chat_end'])->name('chat_end');
    Route::get('/support/{id}/open',[SubscriberController::class,'admin_chat_open'])->name('chat_open');
    Route::post('/support/{id}/send',[SubscriberController::class,'admin_chat_send'])->name('chat_send');

    //Route::post('/settings/general-settings',[SettingsController::class,'general_settings'])->middleware('permission:settings.manage')->name('general_settings');
    Route::controller(AdminController::class)
        ->prefix('admins')
        ->as('admins.')
         ->middleware('permission:admins.manage')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{admin}', 'edit')->name('edit');
            Route::post('update/{admin}', 'update')->name('update');
            Route::delete('destroy/{admin}', 'destroy')->name('destroy');
            Route::get('trashed', 'trashed')->name('trashed');
            Route::get('restore/{id}', 'restore')->name('restore');
        });
    Route::controller(SliderController::class)
        ->prefix('sliders')
        ->as('sliders.')
         ->middleware('permission:sliders.manage')
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
        ->middleware('permission:passengers.manage')
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
        ->middleware('permission:pages.manage')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{page}', 'edit')->name('edit');
            Route::post('update/{page}', 'update')->name('update');
            Route::delete('destroy/{page}', 'destroy')->name('destroy');
            Route::get('trashed', 'trashed')->name('trashed');
            Route::get('restore/{id}', 'restore')->name('restore');
        });

    Route::controller(UserController::class)
        ->prefix('users')
        ->as('users.')
        // ->middleware('permission:users.manage')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{user}', 'edit')->name('edit');
            Route::post('/update/{user}', 'update')->name('update');
            Route::delete('/destroy/{user}', 'destroy')->name('destroy');
            Route::get('/trashed', 'trashed')->name('trashed');
            Route::get('/restore/{id}', 'restore')->name('restore');
        });

    Route::controller(BankController::class)
        ->prefix('banks')
        ->as('banks.')
        // ->middleware('permission:users.manage')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{bank}', 'edit')->name('edit');
            Route::post('/update/{bank}', 'update')->name('update');
            Route::delete('/destroy/{bank}', 'destroy')->name('destroy');
            Route::get('/trashed', 'trashed')->name('trashed');
            Route::get('/restore/{id}', 'restore')->name('restore');
        });
});
