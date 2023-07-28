<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// custom

Route::get('/', [TransactionController::class, 'showAllTransactions']);
Route::get('/deposit', [TransactionController::class, 'showDeposits'])->name('showDepo');
Route::post('/deposit', [TransactionController::class, 'deposit'])->name('postDepo');
Route::get('/withdrawal', [TransactionController::class, 'showWithdrawals'])->name('showWD');
Route::post('/withdrawal', [TransactionController::class, 'withdraw'])->name('postWD');

// custom

require __DIR__.'/auth.php';
