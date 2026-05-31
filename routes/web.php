<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuteurController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;

Route::get('/', [UserController::class,'showDataInHome'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/blog', [PostController::class, 'index'])->name('blog');
Route::get('/fullpost/{id}',[UserController::class,'showFullPost'])->name('fullpost')->middleware('auth');
Route::get('/dashboard', [UserController::class, 'home'])->middleware('auth')->name('dashboard');
Route::post('/subscribe', [App\Http\Controllers\SubscriberController::class, 'store'])->name('subscribe');

// ========== ROUTES CONTACT ==========
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Routes admin pour les messages
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/contact-messages', [ContactController::class, 'messages'])->name('admin.contact.messages');
    Route::get('/contact-messages/{id}', [ContactController::class, 'showMessage'])->name('admin.contact.message.show');
    Route::delete('/contact-messages/{id}', [ContactController::class, 'deleteMessage'])->name('admin.contact.message.delete');
    Route::patch('/contact-messages/{id}/toggle', [ContactController::class, 'toggleRead'])->name('admin.contact.message.toggle');
});

Route::middleware('auth')->group(function () {
    Route::post('/reactions/{postId}', [App\Http\Controllers\ReactionController::class, 'store'])->name('reactions.store');
    Route::post('/follow/{authorId}', [App\Http\Controllers\FollowController::class, 'toggle'])->name('follow.toggle');
    Route::post('/comments/{postId}', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    
    Route::post('/notifications/{id}/read', function($id) {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();
        return response()->json(['ok' => true]);
    })->name('notifications.read');

    Route::get('/notifications/read-all', function() {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');
    
    Route::post('/notifications/read-all', function() {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');
});

Route::get('category/{slug}', [UserController::class, 'showByCategory'])->name('category.show');
Route::get('/categories', [App\Http\Controllers\HomeController::class, 'allCategories'])->name('categories.all');
// Routes pour les favoris
Route::middleware('auth')->group(function () {
    Route::post('/favorite/{postId}', [App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('/favorites', [App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');
});
// ========== ROUTES ADMIN ==========
Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::patch('/posts/{post}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::patch('/posts/{post}/reject', [AdminController::class, 'reject'])->name('admin.reject');
    
    // Gestion des catégories
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
    
    Route::get('/statistiques', [AdminController::class, 'statistiques'])->name('admin.statistiques');
    Route::get('/auteurs', [AdminController::class, 'auteurs'])->name('admin.auteurs');
// Routes pour activer/désactiver les comptes auteurs
    Route::patch('/auteurs/{id}/activate', [AdminController::class, 'activateAuteur'])->name('admin.auteurs.activate');
    Route::patch('/auteurs/{id}/deactivate', [AdminController::class, 'deactivateAuteur'])->name('admin.auteurs.deactivate');
    });

// ========== ROUTES AUTEUR ==========
Route::prefix('auteur')->middleware(['auth','auteur'])->group(function(){
    Route::get('/dashboard', [UserController::class,'index1'])->name('auteur.dashboard');
    Route::get('/dashboard/addpost', [AuteurController::class,'addpost'])->name('auteur.addpost');
    Route::post('/dashboard/createpost', [AuteurController::class,'createpost'])->name('auteur.createpost');
    Route::get('/dashboard/posts/{id}/edit', [AuteurController::class, 'editpost'])->name('auteur.editpost');
    Route::put('/dashboard/posts/{id}', [AuteurController::class, 'updatepost'])->name('auteur.updatepost');
    Route::delete('/dashboard/posts/{id}', [AuteurController::class, 'deletepost'])->name('auteur.deletepost');
});
Route::get('/auteurs', [AboutController::class, 'allAuthors'])->name('authors.all');

// ========== ROUTES PROFIL AUTEUR ==========
Route::get('/auteur/{id}', [UserController::class, 'showAuteurProfile'])->name('auteur.profile');
Route::get('/auteur/{id}/category/{slug}', [UserController::class, 'showAuteurByCategory'])->name('auteur.category');

// ========== ROUTES PROFIL UTILISATEUR ==========
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';