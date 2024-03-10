<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
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

    Route::get('/admin/home', [AdminController::class, 'show_home'])->name('admin_panel_show_home');

    Route::get('/admin/orders', [AdminController::class, 'show_orders'])->name('admin_panel_show_orders');

    Route::get('/admin/customers', [AdminController::class, 'show_customers'])->name('admin_panel_show_customers');
    
    
    Route::get('/admin/menu_categories', [CategoryController::class, 'show'])->name('admin_panel_show_menu_categories');
    Route::post('/admin/menu_categories', [CategoryController::class, 'create'])->name('create_menu_category');
    Route::put('/admin/menu_categories/{id}', [CategoryController::class, 'update'])->name('update_menu_category');
    Route::patch('/admin/menu_categories/{id}', [CategoryController::class, 'patch'])->name('patch_menu_category');
    Route::delete('/admin/menu_ategories/{id}', [CategoryController::class, 'delete'])->name('delete_menu_category');


    Route::get('/admin/menu_items', [FoodController::class, 'show_menu_items'])->name('admin_panel_show_menu_items');

    
    Route::get('/admin/category/{id}/menu_items',[FoodController::class, 'show_by_category'])->name('admin_panel_show_menu_items_by_category');
    Route::post('/admin/menu_items', [FoodController::class, 'create'])->name('create_menu_item');
    
    Route::post('/admin/category/menu_items', [FoodController::class, 'get_by_category'])->name('admin_panel_get_menu_items_by_category');
    Route::put('/admin/category/menu_items/{id}', [FoodController::class, 'update'])->name('update_menu_item');
    Route::patch('/admin/category/menu_items/{id}', [FoodController::class, 'patch'])->name('patch_menu_item');
    Route::delete('/admin/category/menu_items/{id}', [FoodController::class, 'delete'])->name('delete_menu_item');
});


