<?php

use App\Http\Controllers\TopicController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::post('/topics', [TopicController::class, 'store'])->name("topics.store");
Route::get('/topics/', [TopicController::class, 'index'])->name("topics.index");
Route::get('/topics/create', [TopicController::class, 'create'])->name("topics.create");
Route::get('/edit/{topic}', [TopicController::class, 'edit'])->name("topics.edit");
Route::put('/topics/{topic}',[TopicController::class, 'update'])->name("topics.update");
Route::delete('/delete/{topic}', [TopicController::class, 'delete'])->name("topics.delete");

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
