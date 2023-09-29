<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Category\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\customer\Dashboard\DashboardCustomerController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    // Login
    Route::group(['namespace' => 'Auth'], function () {

        Route::get('/login/{type}', [LoginController::class, 'loginForm'])->middleware('guest')->name('login.show');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');
    });

    Route::get('/selection', [HomeController::class, 'selection'])->name('selection');

    Route::resource('/dashboard', DashboardController::class)->name('index', 'admin.dashboard.index')->middleware(['auth', 'verified']);
    Route::resource('/', HomeController::class)->name('index', 'home.index');
    Route::resource('/customers', CustomerController::class)->name('index', 'customers');
    Route::resource('/sdash', CustomerController::class)->name('sdash', 'sdash');
    Route::resource('/categories', CategoryController::class)->name('index', 'categories');
});







require __DIR__ . '/auth.php';
