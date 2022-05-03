<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('register', [RegisteredUserController::class, 'create'])
                ->middleware(['auth'])->name('register');

Route::post('register', [RegisteredUserController::class, 'store'])
                ->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('users', 'App\Http\Controllers\UserController')->parameters(
    [
        'users' => 'user',
    ]
)->middleware(['auth']);

Route::resource('roles', 'App\Http\Controllers\RoleController')->parameters(
    [
        'roles' => 'role',
    ]
)->middleware(['auth']);

Route::post('/role_user', 'App\Http\Controllers\RoleController@roleUserAssigment')->middleware(['auth'])->name('role_user');

require __DIR__.'/auth.php';
