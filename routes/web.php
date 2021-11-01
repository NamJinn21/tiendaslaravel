<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ImportProducts;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationsController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dash');
    }
    return view('auth.login');
});
Route::get('dash', [DashboardController::class, 'index'])
    ->name('dash');

Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');

Route::post('markead', [NotificationsController::class, 'markNotification'])->name('markRead');

Route::get('notifications/show', [NotificationsController::class, 'index'])
    ->name('notification');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('importproducts', ImportProducts::class);
});

Route::get('notifications/get', [NotificationsController::class, 'getNotificationsData'])
    ->name('notifications.get');