<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookContentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

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

Auth::routes();
Route::match(['get', 'post'], '/register', function () {
    return redirect('/');
});



// AUTH GET Controllers
Route::get('/', [UserController::class, 'index'])->middleware('guest');
Route::get('/login', [UserController::class, 'index'])->middleware('guest');
Route::get('/forgot', [UserController::class, 'forgot'])->middleware('guest');
Route::get('/54ckd00r', [UserController::class, 'register'])->middleware('guest');
Route::get('/logout', [UserController::class, 'logout']);
// Route::get('/confirm/{token}', 'UserController@confirmAccount');
// Route::get('/reset/{token}', 'UserController@resetAccount');
Route::get('/user/{userKey}/suspend', [UserController::class, 'userSuspend'])->middleware('auth');
Route::get('/user/{userKey}/activate', [UserController::class, 'userActivate'])->middleware('auth');
Route::get('/user/{userKey}/delete', [UserController::class, 'userDelete'])->middleware('auth');


// AUTH POST Controller
Route::post('/54ckd00r', [UserController::class, 'adminRegister'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');




// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');


// Students Routes
Route::get('/students', [StudentController::class, 'index'])->middleware('auth');
Route::post('/students', [StudentController::class, 'addStudent'])->name('addStudent');
Route::get('/downloadsheet', [StudentController::class, 'downloadSheet'])->middleware('auth');

// Staff Routes
Route::get('/staffs', [StaffController::class, 'index'])->middleware('auth');
Route::post('/staffs', [StaffController::class, 'addStaff'])->name('addStaff');
Route::get('/downloadsheet', [StaffController::class, 'downloadSheet'])->middleware('auth');

// Book Routes
Route::get('/books', [BookController::class, 'index'])->middleware('auth');
Route::post('/books', [BookController::class, 'addBook'])->name('addBook');
Route::get('/shelf', [BookController::class, 'shelf'])->middleware('auth');
Route::get('/publicShelf', [BookController::class, 'publicShelf'])->middleware('guest');

// Content Routes
Route::get('/content', [BookContentController::class, 'content'])->middleware('auth');
Route::get('/addContent', [BookContentController::class, 'addContent'])->middleware('auth');
Route::post('/addContent', [BookContentController::class, 'addContentChapter'])->name('addContent');


// Settings Routes
Route::get('/settings', [UserController::class, 'settings'])->middleware('auth');
Route::post('/settings', [UserController::class, 'updateInfo'])->name('updateInfo');
Route::post('/settingsPassword', [UserController::class, 'updatePassword'])->name('updatePassword');

// Transaction Routes
Route::get('/transaction', [TransactionController::class, 'index'])->middleware('auth');
Route::get('/return', [TransactionController::class, 'return'])->middleware('auth');
Route::post('/borrowing', [TransactionController::class, 'borrowing'])->name('borrowing');
Route::post('/returning', [TransactionController::class, 'returning'])->name('returning');


// Report Routes
Route::get('/reports', [ReportController::class, 'index'])->middleware('auth');
