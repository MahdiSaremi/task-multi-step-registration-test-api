<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function ()
{
    Route::get('/getUser', 'getUser');
    Route::get('/updateEmailPassword', 'updateEmailPhone');
    Route::get('/updatePassword', 'updatePassword');
    Route::get('/updatePersonalInfo', 'updatePersonalInfo');
    Route::get('/finish', 'finish');
});
