<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\POrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return redirect('/dashboard');
});

Auth::routes();
Route::controller(HomeController::class)->group(function () { 
    Route::get('/','index');
    Route::get('/shop','shop');
    Route::get('/contact','contact');
    Route::get('/product/{id}','product');
    Route::post('/message','message');
});
Route::middleware('auth')->group(function () {
    Route::resources([
        'carts'=>CartController::class,
        'orders'=>POrderController::class,
        'products'=>ProductController::class,
        'projects'=>ProjectController::class,
        'milestones'=>MilestoneController::class,
        'tasks'=>TaskController::class,
        'reviews'=>ReviewController::class,
        'finances'=>FinanceController::class,
        'users'=>UserController::class
    ]);
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });
    
});