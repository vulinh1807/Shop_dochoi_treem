<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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
//Frontend
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class,'index']);
Route::get('/home', [HomeController::class,'index']);


//Backend
Route::get('/admin',[AdminController::class,'index']);
Route::get('/dashboard',[AdminController::class,'show_dashboard']);
Route::get('/',function(){
  return response()->json(['stuff'=>phpinfo()]);
});
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout','AdminController@logout');
