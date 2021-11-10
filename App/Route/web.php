<?php
use Core\Route;

Route::get('users', [\App\Controllers\UserController::class, 'index'] );
Route::get('users/show', [\App\Controllers\UserController::class, 'show'] );
Route::post('users/store', [\App\Controllers\UserController::class, 'store'] );
Route::get('users/update', [\App\Controllers\UserController::class, 'update'] );
Route::get('users/delete', [\App\Controllers\UserController::class, 'delete'] );

