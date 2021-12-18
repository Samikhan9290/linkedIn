<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Authentication;
use App\Http\Controllers\ProductController;

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


Route::get('/register',[Authentication::class,'register']);
Route::get('/',[Authentication::class,'login']);
Route::post('/login_process',[Authentication::class,'login_process']);
Route::post('/register',[Authentication::class,'register_process']);

Route::group(['middleware'=>'auth'],function (){
    Route::get('index',[Authentication::class,'index']);
    Route::post('/Add_product',[ProductController::class,'store']);
    Route::get('/fetchData',[ProductController::class,'index']);
    Route::delete('/delete_product/{id}',[ProductController::class,'destroy']);
    Route::get('/edit_product/{id}',[ProductController::class,'edit']);
    Route::put('/update_product/{id}',[ProductController::class,'update']);

});
Route::get('logout', function () {
    session()->forget('USER_LOGIN');
    session()->forget('USER_ID');
    session()->forget('USER_NAME');

    return redirect('/');
});
