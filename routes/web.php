<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/',[RestaurantController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'show_login_form'])->name('login');
Route::post('/login',[LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/admin/home', [AdminController::class, 'show_home'])->name('admin_panel_home')->middleware('auth');

    Route::get('/admin/orders', [AdminController::class, 'show_orders'])->name('admin_panel_orders');
    Route::get('/admin/customers', [AdminController::class, 'show_customers'])->name('admin_panel_customers');
    Route::get('/admin/menu_categories', [CategoryController::class, 'show_menu_categories'])->name('admin_panel_menu_categories');
    Route::get('/admin/menu_items', [AdminController::class, 'show_menu_items'])->name('admin_panel_menu_items');

    // Route::get('/admin/{option}', [AdminController::class, 'show_option'])->name('admin_panel_option');
    Route::post('/admin/menu_categories', [CategoryController::class, 'create']);
    Route::post('/admin/menu_categories/{id}', [CategoryController::class, 'update'])->name('update_category');
    Route::post('/admin.menu_categories', [CategoryController::class, 'update_all'])->name('update_all_categories');
    Route::delete('/admin/menu_categories/{id}', [CategoryController::class, 'delete'])->name('delete_category');

    Route::patch('/admin/menu_categories/{id}', [CategoryController::class, 'update_category_patch'])->name('update_category_patch');
});


