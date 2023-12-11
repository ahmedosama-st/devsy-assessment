<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Auth\Middleware\Authorize;

Route::group(['middleware' => Authorize::using('view dashboard'), 'prefix' => 'admin'], static function () {
    Route::get('dashboard', DashboardController::class)->name('admin.view-dashboard');
});
