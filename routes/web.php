<?php

use Illuminate\Support\Facades\Route;

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
// routes/web.php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return view('index');
});

Route::resource('users', UserController::class);
Route::resource('books', BookController::class);
Route::resource('reservations', ReservationController::class);


// Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');

Route::get("/user", [UserController::class, "index"]);
Route::get("/reservation", [ReservationController::class, "index"]);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashuser', [DashboardController::class, 'userDashboard'])->name('dashuser');
Route::get('/dashbook', [DashboardController::class, 'bookDashboard'])->name('dashbook');
Route::get('/dashreserve', [DashboardController::class, 'reserveDashboard'])->name('dashreservation');
Route::get('/dash/back', [DashboardController::class, 'back'])->name('dash.back');

// Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');





// Route::get('/dash/back', function () {
//     return redirect()->back();
// })->name('dash.back');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
