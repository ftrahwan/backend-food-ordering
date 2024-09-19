<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\API\AuthController;

//FUNCTION AUTH
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

//FUNCTION ADMIN
Route::post('/addFood',[AdminController::class,'addFood']);
Route::put('/updateFood/{id}',[AdminController::class,'updateFood']);
Route::delete('/deleteFood/{id}',[AdminController::class,'deleteFood']);
Route::get('/getTransaction',[AdminController::class,'getTransaction']);

//FUNCTION CUSTOMER
Route::get('/getFood',[CustomerController::class,'getFood']);
Route::post('/orderFood',[CustomerController::class,'orderFood']);
