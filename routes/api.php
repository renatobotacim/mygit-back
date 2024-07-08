<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\v1\ProfileController;

Route::prefix('/profile')->group(function () {
    Route::get('/show/{profile}', [ProfileController::class, 'show']);
    Route::get('/show/{profile}/followers', [ProfileController::class, 'listFollowers']);
    Route::get('/show/{profile}/following', [ProfileController::class, 'listFollowing']);
});
