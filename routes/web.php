<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ArticleController;

use App\Http\Controllers\SubjectController;
use App\Models\Subject;

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

Route::post('subjects/attachSubjectUser', [SubjectController::class, 'subjectUserAssigment'])->name('subject.user');

Route::resource('roles', 'App\Http\Controllers\RoleController')->parameters(
    [
        'roles' => 'role',
    ]
)->middleware(['auth']);

Route::resource('articles', ArticleController::class)->parameters([
    'articles' => 'article'
]);

Route::get('article/index', [ArticleController::class, 'adminIndex'])->name('articles.adminIndex');

Route::post('articles/attachFile', [ArticleController::class, 'attachArticle'])->name('article.document');

Route::get('articles/assign/{article}', [ArticleController::class, 'assignArticle'])->name('article.assign');

Route::post('articles/user', [ArticleController::class, 'attachUserArticle'])->name('article.user');

Route::get('/autors', 'App\Http\Controllers\ArticleController@storeAutor')->middleware(['auth'])->name('article.create_autor');


Route::resource('subjects', SubjectController::class)->parameters([
    'subjects' => 'subject' 
]);

Route::post('/role_user', 'App\Http\Controllers\RoleController@roleUserAssigment')->middleware(['auth'])->name('role_user');

require __DIR__.'/auth.php';
