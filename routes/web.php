<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoteController;

Route::middleware(['auth','admin'])->group(function(){
    Route::get('/admin',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/candidates', [AdminController::class, 'candidates'])->name('admin.candidates.index');
    Route::get('/admin/candidates/create',[AdminController::class,'createCandidate'])->name('admin.candidates.create');
    Route::post('/admin/candidates',[AdminController::class,'storeCandidate'])->name('admin.candidates.store');
    Route::get('/admin/candidates/{candidate}/edit',[AdminController::class,'editCandidate'])->name('admin.candidates.edit');
    Route::put('/admin/candidates/{candidate}',[AdminController::class,'updateCandidate'])->name('admin.candidates.update');
    Route::delete('/admin/candidates/delete-all',[AdminController::class,'destroyAllCandidates'])->name('admin.candidates.destroyAll');
    Route::delete('/admin/candidates/{candidate}',[AdminController::class,'destroyCandidate'])->name('admin.candidates.destroy');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::delete('/admin/users/delete-all', [AdminController::class, 'destroyAllUsers'])->name('admin.users.destroyAll');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/admin/results', [AdminController::class, 'results'])->name('admin.results');
    Route::post('/admin/toggle-voting', [AdminController::class, 'toggleVoting'])->name('admin.toggle-voting');
});
Route::middleware('auth')->post('/vote',[VoteController::class,'vote'])->name('vote');
Route::get('/vote', [VoteController::class, 'index'])->middleware('auth')->name('vote.index');
Route::get('/results', [VoteController::class, 'results'])->middleware('auth')->name('results');
Route::get('/thank-you', function () { return view('thank-you'); });
