<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Dashboard\PostController;

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

Route::get('/', [IndexController::class, 'index']);

Route::group([
    'prefix' => 'dashboard',
    'middleware' => 'auth'
], function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('posts', PostController::class)->only(['index', 'create', 'edit']);
});

require __DIR__ . '/auth.php';
