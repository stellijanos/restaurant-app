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

    Route::get('/admin/home', [AdminController::class, 'show_home'])->name('admin_panel_home')->middleware('auth');

    Route::get('/admin/orders', [AdminController::class, 'show_orders'])->name('admin_panel_orders');
    Route::get('/admin/customers', [AdminController::class, 'show_customers'])->name('admin_panel_customers');
    
    
    Route::get('/admin/menu_categories', [CategoryController::class, 'show_menu_categories'])->name('admin_panel_menu_categories');
    Route::post('/admin/menu_categories', [CategoryController::class, 'create']);
    Route::put('/admin/menu_categories/{id}', [CategoryController::class, 'update'])->name('update_category');
    Route::patch('/admin/menu_categories/{id}', [CategoryController::class, 'update_category_patch'])->name('update_category_patch');
    Route::delete('/admin/menu_categories/{id}', [CategoryController::class, 'delete'])->name('delete_category');


    Route::get('/admin/menu_items', [FoodController::class, 'show_menu_items'])->name('admin_panel_menu_items');
    Route::post('/admin/menu_items', [FoodController::class, 'create'])->name('admin_panel_create_menu_item');
});


