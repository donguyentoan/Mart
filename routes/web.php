<?php

use App\Http\Controllers\Controller;
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

Route::get('/dashboard', function () {
    return view('admin.index');
});
Route::get('/table', function () {
    return view('admin.table.table');
});
Route::get('/billing', function () {
    return view('admin.billing.billing');
});
Route::get('/profile', function () {
    return view('admin.profile.profile');
});
Route::get('/sign-in', function () {
    return view('admin.auth.sign-in');
});
Route::get('/sign-up', function () {
    return view('admin.auth.sign-up');
});
Route::get('/manager', function () {
    return view('admin.manager.index');
});
Route::get('/add-product', function () {
    return view('admin.manager.Products.add');
});

Route::get('/detail', [Controller::class , 'index']);

