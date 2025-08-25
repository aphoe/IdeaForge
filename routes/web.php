<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return redirect('user');
    return view('welcome');
});

Route::prefix('demo')
    ->middleware(\Filament\Http\Middleware\Authenticate::class)
    ->group(function () {
        Route::get('notify', [App\Http\Controllers\DemoController::class, 'notify']);
    });
