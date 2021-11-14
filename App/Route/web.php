<?php
use \App\Core\Route;
Route::get('users', [App\App\Controllers\UserController::class, 'index'] );
Route::get('users/show', [App\App\Controllers\UserController::class, 'show'] );
Route::post('users/store', [App\App\Controllers\UserController::class, 'store'] );
Route::get('users/update', [App\App\Controllers\UserController::class, 'update'] );
Route::get('users/delete', [App\App\Controllers\UserController::class, 'delete'] );




Route::post('register', [App\App\Controllers\RegisterController::class, 'store'] );
Route::get('/', [App\App\Controllers\RegisterController::class, 'show'] );
Route::get('register', [App\App\Controllers\RegisterController::class, 'create'] );

Route::resolve();