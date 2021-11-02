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
//validando auth
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dash');
    }
    return view('auth.login');
});
//controlador del dash
Route::get('dash', [DashboardController::class, 'index'])
    ->name('dash');

//marcar todas las notificaciones como leídas directamente
Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');
//controlador de notificaciones
Route::post('markead', [NotificationsController::class, 'markNotification'])->name('markRead');
Route::get('notifications/get', [NotificationsController::class, 'getNotificationsData'])
    ->name('notifications.get');
Route::get('notifications/show', [NotificationsController::class, 'index'])
    ->name('notification');

//grupo de rutas principales
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('importproducts', ImportProducts::class);
});

