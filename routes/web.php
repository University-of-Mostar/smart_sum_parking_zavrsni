<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ParkingsController;
use App\Http\Controllers\DashboardControlller;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UsersCOntroller;
use App\Http\Controllers\AppController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;

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

/* Route::get('/', function () {
    return view('welcome');
});
 */
Route::get('/', [DashboardControlller::class, 'index'])->name('index');


/* Route::get('/dashboard', function () {
    return view('C:\Users\38595\Desktop\zavrsni\laravelSocket\vendor\jhumanj\laravel-model-stats\resources\views\dashboard.blade.php');
})->middleware(['auth'])->name('dashboard'); */

require __DIR__.'/auth.php';

//DOHVAT PODATAKA SA API-a
Route::get('/fetchParkings', [DashboardControlller::class, 'fetchParkings'])->name('fetchParkings.data');
Route::get('/fetchLots', [DashboardControlller::class, 'fetchLots'])->name('fetchLots.data');


Route::get('/dashboard', [DashboardControlller::class, 'index'])->name('admin.index');

//PARKINZI
Route::get('/parking1', [ParkingsController::class, 'parking1'])->name('parking1.data');
Route::get('/parking2', [ParkingsController::class, 'parking2'])->name('parking2.data');
Route::get('/parking3', [ParkingsController::class, 'parking3'])->name('parking3.data');

//STATISTIKA
Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
Route::get('/statisticsAll', [StatisticsController::class, 'index2'])->name('statisticsAll.index');

//NOVA STATISTIKA
Route::get('/statistics1', [StatisticsController::class, 'statistics1'])->name('statistics1.index');
Route::get('/statistics2', [StatisticsController::class, 'statistics2'])->name('statistics2.index');
Route::get('/statistics3', [StatisticsController::class, 'statistics3'])->name('statistics3.index');

//USERS
Route::get('/users', [UsersCOntroller::class, 'users'])->name('users.index')->middleware('admin');
Route::get('/users/{id}/toggleAdmin', [UsersCOntroller::class, 'toggleUser'])->middleware('super_admin')->name('admin.user.toggle');
Route::get('/users/{id}/toggleUser', [UsersCOntroller::class, 'toggleAdmin'])->middleware('super_admin')->name('user.user.toggle');


//LOGOUT
Route::get('logout', function ()
{
    Auth::logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

Route::get('/health', [AppController::class, 'health']);
