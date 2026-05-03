<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAnswerController;
use App\Http\Controllers\UserLikeController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

Route::get('/', function () {
    $posts = Post::orderBy('created_at', 'desc')->with('user')->with('likes')->limit(3)->get();

    return view('home', ['posts' => $posts]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/@{username}', [ProfileController::class, 'show'])->where('username', '[A-Za-z0-9-_]+');

Route::resource('posts', PostController::class)->except(['index', 'show'])->middleware('auth');
Route::resource('posts', PostController::class)->only(['index', 'show']);

Route::singleton('my-profile', MyProfileController::class)->destroyable()->middleware('auth');

Route::match(['put', 'patch'], '/likes/{post}', [LikeController::class, 'update'])->middleware('auth');

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/register', 'showRegister');
    Route::post('/auth/register', 'register');
    Route::get('/auth/login', 'showLogin')->name('login');
    Route::post('/auth/login', 'login');
    Route::post('/auth/logout', 'logout')->middleware('auth');
});

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth');

// Nouvelles routes — auth requise
Route::middleware(['auth', 'has.answers'])->group(function () {
    // Profils compatibles
    Route::get('/profiles', [ProfileController::class, 'index']);

    // Like / Unlike depuis la page profil
    Route::post('/users/{username}/like', [UserLikeController::class, 'store'])
        ->where('username', '[A-Za-z0-9-_]+');

    // Matches
    Route::get('/matches', [MatchController::class, 'index']);
});
Route::middleware('auth')->group(function () {

    // Réponses aux questions
    Route::get('/questions', [UserAnswerController::class, 'index']);
    Route::post('/questions', [UserAnswerController::class, 'store']);
});

Route::resource('tokens', TokenController::class)->only(['index', 'create', 'store', 'destroy'])->middleware('auth');
