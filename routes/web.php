<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TinyMceController;
use App\Http\Controllers\Administrations\PostController;
use App\Http\Controllers\Administrations\TypeController;
use App\Http\Controllers\Administrations\UserController;
use App\Http\Controllers\Administrations\AdminController;
use App\Http\Controllers\Administrations\EventController;
use App\Http\Controllers\Administrations\ProjectController;
use App\Http\Controllers\Administrations\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*ADMIN ROUTES */
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    //User routes
    Route::get('/users.profile', [UserController::class, 'profile'])->name('users.profile');
    Route::post('/picture', [UserController::class, 'changePicture'])->name('users.changePicture');
    Route::get('/users.index', [UserController::class, 'index'])->name('users.index');

    //Project Routes
    Route::get('/typeProject.index', [TypeController::class, 'index'])->name('type.project');
    Route::get('/project.index', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project.create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/project.add', [ProjectController::class, 'add'])->name('project.add');
    Route::get('/project.edit/{slug}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('/project.update/{project}', [ProjectController::class, 'update'])->name('project.update');

    Route::post('/upload_tinymce_image', [TinyMceController::class, 'upload_tinymce_image'])->name('upload_tinymce_image');

    //Post Routes
    Route::get('/category.index', [CategoryController::class, 'index'])->name('category.post');
    Route::get('/post.index', [PostController::class, 'index'])->name('post.index');
    Route::get('/post.create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post.add', [PostController::class, 'add'])->name('post.add');
    Route::get('/post.edit/{slug}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post.update/{post}', [PostController::class, 'update'])->name('post.update');

    Route::post('/upload_tinymce_posts_image', [TinyMceController::class, 'upload_tinymce_posts_image'])->name('upload_tinymce_posts_image');

    //event admin
    Route::post('/events.add',[EventController::class,'add'])->name('event.add');
    Route::get('/events.create',[EventController::class,'create'])->name('event.create');
    Route::get('/events.edit/{slug}',[EventController::class,'edit'])->name('event.edit');
    Route::post('/events.update/{event}',[EventController::class,'update'])->name('event.update');
    Route::get('/events',[EventController::class,'index'])->name('event.index');

    Route::post('/upload_tinymce_events_image', [TinyMceController::class, 'upload_tinymce_events_image'])->name('upload_tinymce_events_image');
});

require __DIR__ . '/auth.php';
