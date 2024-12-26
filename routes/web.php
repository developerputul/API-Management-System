<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//Admin All Route//
Route::middleware(['auth',])->group(function(){

    Route::get('/admin/dashboard',[AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout');

    //Category All Route
    Route::get('/all/category',[CategoryController::class,'AllCategory'])->name('all.category');
    Route::get('/add/category',[CategoryController::class,'AddCategory'])->name('add.category');
    Route::post('/category/store',[CategoryController::class,'CategoryStore'])->name('category.store');
    Route::get('/edit/category/{id}',[CategoryController::class, 'EditCategory'])->name('edit.category');
    Route::post('/update/category',[CategoryController::class, 'UpdateCategory'])->name('update.category');
    Route::get('/delete/category/{id}',[CategoryController::class, 'DeleteCategory'])->name('delete.category');

}); //End Admin All Group Route

