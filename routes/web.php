<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\WasteCategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MaterialController as AdminMaterialController;
use App\Http\Controllers\Admin\MaterialCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CKEditorController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/guide', [GuideController::class, 'index'])->name('guide');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/klasifikasi', [KlasifikasiController::class, 'index'])->name('klasifikasi');

Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
Route::get('/materials/search', [MaterialController::class, 'search'])->name('materials.search');
Route::get('/materials/category/{slug}', [MaterialController::class, 'byCategory'])->name('materials.category');
Route::get('/materials/{slug}', [MaterialController::class, 'show'])->name('materials.show');
Route::get('/materi', [MaterialController::class, 'index'])->name('materi');

Route::get('/diskusi', [QuestionController::class, 'index'])->name('diskusi');

Route::resource('questions', QuestionController::class);
Route::post('questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');
Route::post('answers/{answer}/accept', [AnswerController::class, 'accept'])->name('answers.accept');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/email/edit', [ProfileController::class, 'editEmail'])->name('email.edit');
    Route::put('/email', [ProfileController::class, 'updateEmail'])->name('email.update');

    Route::get('/password/edit', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});


Route::get('/prediction', [PredictionController::class, 'index'])->name('prediction');

Route::get('/waste-category/{className}', [WasteCategoryController::class, 'getCategoryInfo']);

Route::get('/game', function () {
    return view('game');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('materials', AdminMaterialController::class);
    Route::resource('material-categories', MaterialCategoryController::class);

});

Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

