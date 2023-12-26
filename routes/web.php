<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\login\loginController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function (){

    Route::match(['get' ,'post'],'login',[loginController::class, 'login'])->name('login');
    Route::match(['get','post'] ,'forget-password',[loginController::class, 'forgetPassword'])->name('forget-password');

    Route::group(['middleware' =>['auth']], function(){
        
        Route::get('dashboard',[adminController::class,'dashboard']);
        Route::get('logout',[loginController::class,'logout'])->name('logout');

    });
});



