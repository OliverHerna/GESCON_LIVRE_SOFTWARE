<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SubjectController;
use App\Models\Event;
use App\Models\Session;

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

    $events = Event::all();
    $sessions = Session::all();
    return view('dashboard')->with([
        'events' => $events,
        'sessions' => $sessions,
    ]); 
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

//Session Routes
Route::resource('sessions', SessionController::class)->parameters([
    'sessions' => 'session'
]);

Route::get('sessions/articles/{session}', [SessionController::class, 'assignArticleView'])
->name('sessions.articles');

Route::post('sessions/articles', [SessionController::class, 'assignArticleToSession'])
->name('sessions.articles_store');

//Event Routes
Route::resource('events', EventController::class)->parameters([
    'events' => 'event'
]);

Route::get('events/user_view/{event}', [EventController::class, 'assignManagerView'])->name('event.user_view');

Route::post('events/user', [EventController::class, 'assignManager'])->name('event.user');

Route::post('/role_user', 'App\Http\Controllers\RoleController@roleUserAssigment')->middleware(['auth'])->name('role_user');

require __DIR__.'/auth.php';
