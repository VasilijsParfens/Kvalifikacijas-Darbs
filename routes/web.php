<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\AdminCollectionController;
use App\Http\Controllers\AdminPlantCommentController;
use App\Http\Controllers\AdminPlantController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;

// General Controllers
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PlantCommentController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantIdentificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowcaseController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;

Route::get('/plants/create', [PlantController::class, 'create'])->name('plants.create');
Route::post('/plants', [PlantController::class, 'store'])->name('plants.store');

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/search', [SearchController::class, 'search'])->name('search');

// Authentication Routes

Route::view('/register', 'user.register')->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::view('/login', 'user.login')->name('login');
Route::post('/login', [UserController::class, 'login']);


Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// Plant Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/plants/{plant}/collection', [CollectionController::class, 'store'])->name('user_plant_collection.store');
    Route::delete('/plants/{plant}/collection', [CollectionController::class, 'remove'])->name('user_plant_collection.remove');
    Route::post('/plants/{plantId}/comments', [PlantCommentController::class, 'store'])->name('plant_comments.store');
});

Route::get('/plants/{plant}', [PlantController::class, 'show'])->name('plants.show');

// Profile Routes
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

// Question and Answer Routes
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');

Route::middleware('auth')->group(function () {
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('question_answers.store');
    Route::post('/answers/{answer}/upvote', [AnswerController::class, 'upvote'])->name('answer_votes.upvote');
    Route::post('/answers/{answer}/downvote', [AnswerController::class, 'downvote'])->name('answers.downvote');
    Route::post('/answers/{answer}/mark-best/{question}', [AnswerController::class, 'markBestAnswer'])->name('answer.markBest');
});

// Showcase Routes
Route::middleware('auth')->group(function () {
    Route::get('/showcase/create', [ShowcaseController::class, 'create'])->name('showcases.create');
    Route::post('/showcase', [ShowcaseController::class, 'store'])->name('showcases.store');
});

// Tips Routes
Route::get('/tips', [TipsController::class, 'index'])->name('tips.index');
Route::get('/tips/{tip}', [TipsController::class, 'show'])->name('tips.show');

Route::middleware('auth')->group(function () {
    Route::get('/tips/create', [TipsController::class, 'create'])->name('tips.create');
    Route::post('/tips', [TipsController::class, 'store'])->name('tips.store');
});

// Plant Identification Routes
Route::middleware('auth')->group(function () {
    Route::get('/plant-identifications/create', [PlantIdentificationController::class, 'create'])->name('plant-identifications.create');
    Route::post('/plant-identifications', [PlantIdentificationController::class, 'store'])->name('plant-identifications.store');
});

// Admin Routes – No prefix, no 'except', direct individual route definitions

// Admin: Plants
Route::get('/admin/plants', [AdminPlantController::class, 'index'])->name('admin.plants.index');
Route::post('/admin/plants', [AdminPlantController::class, 'store'])->name('admin.plants.store');
Route::put('/admin/plants/{plant}', [AdminPlantController::class, 'update'])->name('admin.plants.update');
Route::delete('/admin/plants/{plant}', [AdminPlantController::class, 'destroy'])->name('admin.plants.destroy');

// Admin: Users
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

// Admin: Collections
Route::get('/admin-collections', [AdminCollectionController::class, 'index'])->name('admin.collections.index');
Route::delete('/admin-collections/{collection}', [AdminCollectionController::class, 'destroy'])->name('admin.collections.destroy');

// Admin: Posts
Route::get('/admin-posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
Route::delete('/admin-posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');

// Admin: Plant Comments
Route::get('/admin-plant-comments', [AdminPlantCommentController::class, 'index'])->name('admin.plant_comments.index');
Route::delete('/admin-plant-comments/{comment}', [AdminPlantCommentController::class, 'destroy'])->name('admin.plant_comments.destroy');


// Post Routes
Route::get('/posts/create/{type}', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/lists/{type}', [PostController::class, 'showList'])->name('posts.lists.show');


Route::middleware('auth')->group(function () {
    Route::post('/users/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow');
    Route::post('/users/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow');
});

Route::post('/plants/{plant}/comments', [PlantCommentController::class, 'store'])->name('plant_comments.store');


Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');

Route::delete('/comments/{comment}', [PlantCommentController::class, 'destroy'])->name('comments.destroy');
