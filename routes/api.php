<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function ()
{
    Route::post('/getUser', 'getUser');
    Route::post('/update', 'update');
    Route::post('/finish', 'finish');
});
