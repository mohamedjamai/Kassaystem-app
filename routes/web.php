<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\Kassascherm;
use App\Http\Controllers\Auth\KassaschermController;
use App\Http\Controllers\Auth\LoginpinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\YController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\PincodeRedirect;
use App\Http\Controllers\SushirollsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderLineController;


Route::post('/handleProductClick', [ProductController::class, 'handleProductClick']);


/*.
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Definieer de route voor het opslaan van de bestelling
Route::post('/saveOrder', [OrderController::class, 'store'])->name('saveOrder');

Route::post('/orderline', [OrderLineController::class, 'store']);



Route::get('/', function () {
    return view('welcome');
});

Route::post('/handleProductClick', [ProductController::class, 'handleProductClick']);

//Mohamed Jamai Studentnummer 2150953

Route::post('/save-clicked-product', function () {
    //
});


Route::get('/getProducts', [ProductController::class, 'getProductsByCategory']);


Route::get('/kassascherm', [KassaschermController::class, 'vieuw'])->name('kassascherm');

Route::get('/loginpin', [LoginpinController::class, 'vieuw'])->name('loginpin');

Route::post('/loginpin/dologin', [LoginpinController::class, 'loginWithPin'])->name('loginWithPin');


Route::get('/sushirolls', [SushirollsController::class, 'dashboard']);



Route::get('/dashboard',[YController::class, 'vieuw'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
