<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WahanaController;

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


// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);



// Halaman registrasi
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return view('home');
});
// Route::get('/home', function () {
//     return view('home');
// });
// Route untuk dashboard berdasarkan role
Route::middleware('auth')->get('/admin-dashboard', function () {
    if (auth()->user()->role !== 'admin') {
        return redirect('/user-dashboard'); // Redirect jika bukan admin
    }
    return view('admin.dashboard'); // Halaman dashboard admin
});

Route::middleware('auth')->get('/user-dashboard', function () {
    return view('user.dashboard'); // Halaman dashboard pengguna biasa
});

Route::get('/wahana', [WahanaController::class, 'index'])->name('admin.wahana.index');
Route::get('/admin/wahana/create', [WahanaController::class, 'create'])->name('admin.wahana.create');

