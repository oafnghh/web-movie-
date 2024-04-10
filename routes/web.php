<?php

use App\Http\Controllers\AdminController\AdminController;
use App\Http\Controllers\ClientController\ClientController;
use App\Http\Controllers\DropZoneController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;
use App\Models\blog;
use App\Models\slider;
use App\Models\User;
use App\Models\movie;
use App\Models\genre;
use App\Models\listMovie;
use App\Models\Statistical;
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
// cho admin
Route::get("/login", [LoginController::class, "Login"])->name('login');
Route::get("/signup", [LoginController::class, "SignUp"]);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post("/signup", [User::class, "Create"])->name("SignUp");
Route::post("/login", [User::class, "login"])->name("login");
Route::post("/comment", [UploadController::class, "comment"])->name('comment');
Route::post('/blogMxh', [UploadController::class, 'blog'])->name('ajax.blog');
Route::get('/forget-password', [LoginController::class, 'forgetPass'])->name('fogetPass');
Route::post('/forget-password', [LoginController::class, 'actived']);
Route::get('/get-password/{user}/{token}', [LoginController::class, 'getPass'])->name('getPass');
Route::post('/get-password/{user}/{token}', [LoginController::class, 'postGetPass'])->name('postForget');

Route::middleware('auth')->group(function () {
    Route::get('chat', [ClientController::class, 'chat'])->name('chat');
    Route::post('message', [ClientController::class, 'message']);
    Route::prefix("/admin")->group(function () {
        Route::get("/", [AdminController::class, 'index'])->name('admin');
        Route::get("/noen", [AdminController::class, 'noen']);
        Route::post("/upload/services", [UploadController::class, 'upload']);
        Route::post('/upload-video/services', [DropZoneController::class, 'store']);
        Route::prefix('slider')->group(function () {
            Route::get("/", [AdminController::class, 'slider']);
            Route::get('/add', [AdminController::class, 'addSlider']);
            Route::post('/add', [slider::class, 'add'])->name('AddSlide');
            Route::get('/list', [AdminController::class, 'listSlider']);
            Route::get('/edit/{id}', [AdminController::class, 'editSlider']);
            Route::post('/edit/{id}', [slider::class, 'edit'])->name('edit');
            Route::get('/delete/{id}', [slider::class, 'deleteSlider'])->name('delete');
        });
        Route::prefix('movie')->group(function () {
            Route::get("/", [AdminController::class, 'movie']);
            Route::get('/add', [AdminController::class, 'addmovie']);
            Route::post('/add', [movie::class, 'add'])->name('AddMovie');
            Route::get('/list', [AdminController::class, 'listMovie']);
            Route::get('/edit/{id}', [AdminController::class, 'editmovie']);
            Route::post('/edit/{id}', [movie::class, 'edit'])->name('edit');
            Route::get('/delete/{id}', [movie::class, 'deletemovies'])->name('delete');
        });
        Route::prefix('genre')->group(function () {
            Route::get("/", [AdminController::class, 'genre']);
            Route::get('/add', [AdminController::class, 'addgenre']);
            Route::post('/add', [genre::class, 'add'])->name('Addgenre');
            Route::get('/list', [AdminController::class, 'listgenre']);
            Route::get('/edit/{id}', [AdminController::class, 'editgenre']);
            Route::post('/edit/{id}', [genre::class, 'edit'])->name('edit');
            Route::get('/delete/{id}', [genre::class, 'deletegenre'])->name('delete');
        });
        Route::prefix('listMovie')->group(function () {
            Route::get("/", [AdminController::class, 'listMovie']);
            Route::get('/add', [AdminController::class, 'addlistMovie']);
            Route::post('/add', [listMovie::class, 'add'])->name('AddListMovie');
            Route::get('/list', [AdminController::class, 'listlistMovie']);
            Route::get('/edit/{id}', [AdminController::class, 'editlistMovie']);
            Route::post('/edit/{id}', [listMovie::class, 'edit'])->name('edit');
            Route::get('/delete/{id}', [listMovie::class, 'deletelistMovie'])->name('delete');
        });
        Route::prefix('statistical')->group(function () {
            Route::get('/', [AdminController::class, 'statisMain']);
            Route::post('/getAccessData', [Statistical::class, 'getAccessData'])->name('year');
        });
    });
});
// cho client
Route::prefix("/")->group(function () {
    // giao diện trang chủ
    Route::get("/header", [ClientController::class, "header"]);
    Route::get('/', [ClientController::class, 'index'])->name('trangchu')->middleware('logVisit');
    Route::get('/watch/{id}/{movie}', [ClientController::class, 'watch']);
    Route::get('/search', [ClientController::class, 'Search'])->name('Search');
    Route::get('/genre/{id}', [ClientController::class, 'GenreList']);
    Route::get('/banner/{slug}', [ClientController::class, 'banner'])->name('banner');
    Route::get('/blog', [ClientController::class, 'blog'])->name('blog');
    Route::get('/blog/{id}', [ClientController::class, 'blogComment']);
    Route::get('/like/{id}', [blog::class, 'like'])->name('like');
    Route::post('/commentBlog', [UploadController::class, 'commentBlog'])->name('commentBlog');
    Route::get('/delete/blog/{id}', [ClientController::class, 'deletePost']);

    Route::get('/profile/{id}', [ClientController::class, 'profile']);
    Route::POST('/updateUser/{id}', [ClientController::class, 'updateUser'])->name('updateUser');
});
Route::get('auth/facebook', [LoginController::class, 'redirectToFacebook'])->name('login-by-facebook');
Route::get('auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('login-by-google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::fallback(function () {
    return view('client.404');
});
Route::POST('/chartday', [AdminController::class, 'chartday']);
Route::POST('/chart30day', [AdminController::class, 'chart30day']);
Route::POST('/chartdayhai', [AdminController::class, 'chartdayhai']);