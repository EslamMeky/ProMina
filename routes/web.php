<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PictureController;
use Illuminate\Support\Facades\Route;

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
define('PAGINATE',3);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/saveAlbum',[AlbumController::class,'save'])->name('addAlbum');
Route::get('/editAlbum/{id}',[AlbumController::class,'edit'])->name('editAlbum');
Route::post('/updateAlbum/{id}',[AlbumController::class,'update'])->name('updateAlbum');
Route::get('/deleteAll/{id}',[AlbumController::class,'deleteAll'])->name('deleteAll');
Route::get('/delete/{id}',[AlbumController::class,'delete'])->name('delete');


//////////////////        pictures    /////

Route::get('/Pictures',[PictureController::class,'index'])->name('index.picture');
Route::post('/save',[PictureController::class,'save'])->name('savePhoto');


Route::get('/move/{id}',[PictureController::class,'move'])->name('move');
Route::post('/MoveTo/{id}',[PictureController::class,'MoveTo'])->name('update');
