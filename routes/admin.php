<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\DepositBalance;
use App\Http\Controllers\Admin\OrderController;
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
use App\Http\Controllers\GlobalController;
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
Route::name('admin.')->prefix('admin')->middleware('admin')->group(function (){
    Route::get('/',[Dashboard::class,'index'])->name('dashboard');
    Route::get('/subscribers',[SubscriberController::class,'index'])->name('subscribers');
    // Deposit
    Route::get('/deposits',[UserBalance::class,'index'])->name('deposits');
    Route::get('/deposits/create',[DepositBalance::class,'create'])->name('deposits.create');
    Route::post('/deposits/store',[DepositBalance::class,'store'])->name('deposits.store');

    Route::get('/deposit/{id}/approve',[UserBalance::class,'deposit_approve'])->name('deposit_approve');
    Route::get('/deposit/{id}/reject',[UserBalance::class,'deposit_reject'])->name('deposit_reject');

    Route::get('/page/about',function () {return view('admin.page.about');});
    Route::get('/page/visa',function () {return view('admin.page.visa');});
    Route::get('/page/contact',function () {return view('admin.page.contact');});
    Route::get('/page/privacy',function () {return view('admin.page.privacy');});
    Route::get('/page/refund',function () {return view('admin.page.refund');});
    Route::get('/page/cancellation',function () {return view('admin.page.cancellation');});
    Route::get('/page/terms',function () {return view('admin.page.terms');});
    Route::get('/page/testimonials',function () {return view('admin.page.testimonials');});
    Route::post('/page/update',[SettingsController::class,'update_custom_page'])->name('update_custom_page');

    Route::get('/settings/general',[SettingsController::class,'general_settings'])->middleware('permission:settings.manage')->name('general_settings');
    Route::get('/settings/profit',[SettingsController::class,'profit_settings'])->middleware('permission:settings.manage')->name('profit_settings');
    Route::get('/settings/sms',[SettingsController::class,'sms_settings'])->middleware('permission:settings.manage')->name('sms_settings');
    Route::post('/settings/general/update',[SettingsController::class,'update_general_settings'])->middleware('permission:settings.manage')->name('update_general_settings');
    Route::get('/settings/flyhub',[SettingsController::class,'flyhub_settings'])->middleware('permission:settings.manage')->name('flyhub_settings');
    Route::post('/settings/flyhub-settings',[SettingsController::class,'update_flyhub_settings'])->middleware('permission:settings.manage')->name('update_flyhub_settings');
    Route::post('/settings/update',[SettingsController::class,'update_settings'])->middleware('permission:settings.manage')->name('update_settings');
    Route::post('settings/test-sms',[SettingsController::class,'test_sms_send'])->name('test_sms_send');

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
            Route::get('/show/{user}', 'show')->name('show');
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
        Route::get('orders',[OrderController::class,'index'])->name('orders')->middleware('permission:orders.manage');
        Route::get('order/{id}',[OrderController::class,'order_details'])->name('order_details')->middleware('permission:orders.manage');
        Route::get('order/{id}/refresh',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'order_refresh'])->name('order_refresh');
        Route::get('order/{id}/ticket-issue',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'ticket_issue'])->name('ticket_issue');
        Route::get('order/{id}/cancel-ticket',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'cancel_ticket'])->name('cancel_ticket');
        Route::get('order/{id}/invoice/{p}',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'invoice'])->name('invoice');
        Route::get('order/{id}/downloadTicket/{ticket}/{pax_index}',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'downloadTicket'])->name('downloadTicket');

        // Refund
        Route::get('/refunds',[DepositBalance::class,'refunds'])->name('refunds');
        Route::get('/refunds/create',[DepositBalance::class,'refund_create'])->name('refunds.create');
        Route::post('/refunds/store',[DepositBalance::class,'refund_store'])->name('refunds.store');


        Route::get('log/trans',[GlobalController::class,'transactions'])->name('transactions');
        Route::get('log/email',[GlobalController::class,'emails'])->name('emails');
        Route::get('send/email',[GlobalController::class,'send_email'])->name('send_email');
        Route::get('send/sms',[GlobalController::class,'send_sms'])->name('send_sms');
        Route::post('send/email',[GlobalController::class,'email_send'])->name('email_send');
        Route::post('send/sms',[GlobalController::class,'sms_send'])->name('sms_send');
        Route::get('log/sms',[GlobalController::class,'sms'])->name('sms');
});
