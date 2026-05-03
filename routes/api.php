<?php

use App\Http\Controllers\Api\v1\ApiMatchController;
use App\Http\Controllers\Api\v1\ApiProfileController;
use App\Http\Controllers\Api\v1\ApiUserLikeController;
use App\Http\Controllers\Api\v1\ApiPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('v1/posts', ApiPostController::class)
    ->middlewareFor(['index', 'show'], ['auth:sanctum', 'abilities:posts:read'])
    ->middlewareFor(['store'], ['auth:sanctum', 'abilities:posts:create'])
    ->middlewareFor(['update'], ['auth:sanctum', 'abilities:posts:update'])
    ->middlewareFor(['destroy'], ['auth:sanctum', 'abilities:posts:delete']);

Route::apiResource('v1/profiles', ApiProfileController::class)
    ->middlewareFor(['index', 'show'], ['auth:sanctum', 'abilities:profiles:read', 'has.answers']);

Route::get('v1/likes', [ApiUserLikeController::class, 'index'])
    ->middleware(['auth:sanctum', 'abilities:likes:read', 'has.answers']);
Route::post('v1/likes/{username}', [ApiUserLikeController::class, 'store'])
    ->middleware(['auth:sanctum', 'abilities:likes:write', 'has.answers'])
    ->where('username', '[A-Za-z0-9-_]+');

Route::apiResource('v1/matches', ApiMatchController::class)
    ->middlewareFor(['index'], ['auth:sanctum', 'abilities:matches:read', 'has.answers']);
