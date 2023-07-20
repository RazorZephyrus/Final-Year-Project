<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\UsersController;
use App\Helpers\MyRoute;
use App\Http\Controllers\Web\AsramaController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\FasilitasController;
use App\Http\Controllers\Web\PesananController;
use App\Http\Controllers\Web\Profile\ProfileController;
use App\Http\Controllers\Web\Profile\ChangeAvatarController;
use App\Http\Controllers\Web\Profile\ChangePasswordController;
use App\Http\Controllers\Web\RoomController;
use App\Http\Controllers\Web\RoomTypeController;
use App\Http\Controllers\Web\SettingController;

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
    if (empty(auth()->user())) {
        return redirect('/landing');
    } else {
        return redirect(route('web.dashboard'));
    }
});

// LANDING PAGE
Route::get('/landing', [App\Http\Controllers\LandingPageController::class, 'landingPages'])->name('web.homepage.front');
Route::get('/asrama-detail/{id}', [App\Http\Controllers\LandingPageController::class, 'asramaDetail'])->name('web.homepage.detail-asrama.front');
Route::get('/list-room', [App\Http\Controllers\ListRoomController::class, 'listRoom'])->name('web.homepage.list-room.front');
Route::get('/room/detail/{id}', [App\Http\Controllers\LandingPageController::class, 'roomDetail'])->name('web.homepage.room-detail.front');
# booking ROOM
Route::post('/room/booking', [App\Http\Controllers\LandingPageController::class, 'RoomBooking'])->name('web.homepage.room-booking.front');

// Route::get('/list-room', function () {
//     return view('front.rooms.list-room');
//  });
Route::get('/pusat-bantuan', function () {
    return view('front.landing.bantuan');
 });
Route::get('/syarat-dan-ketentuan', function () {
    return view('front.landing.syarat');
 });

//  PESANAN 


// Auth::routes();
Route::namespace('App\Http\Controllers\Web')
    ->group(
        function () {
            Route::get('login', function () {
                return view('auth.login');
            })->name('login');
            Route::get('register', function () {
                return view('auth.register');
            })->name('register');
            Route::post('login', [LoginController::class, 'login']);
            Route::post('register', [RegisterController::class, 'register'])->name('do_register');
            Route::post('logout', [LoginController::class, 'logout'])->name('logout');
            Route::get('/files', [App\Http\Controllers\HomeController::class, 'getFiles'])->name('web.getfiles');
            Route::group(['middleware' => 'auth:web'], function () {
                Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('web.dashboard');

                Route::prefix('user')->group(function () {
                    MyRoute::resourceWEB('profile', ProfileController::class, 'profile', ['index', 'store']);
                    MyRoute::resourceWEB('change-password', ChangePasswordController::class, 'profile.password', ['index', 'store']);
                    MyRoute::resourceWEB('change-avatar', ChangeAvatarController::class, 'profile.avatar', ['index', 'store']);
                });

                Route::group(['prefix' => 'settings'], function () {
                    Route::get('/', [SettingController::class, 'index'])->name('web.settings.index');
                    Route::put('/{id}', [SettingController::class, 'update'])->name('web.settings.update');
                });

                Route::group(['prefix' => 'users'], function () {
                    Route::get('/', [UsersController::class, 'index'])->name('web.users.index');
                    Route::get('/create', [UsersController::class, 'create'])->name('web.users.create');
                    Route::post('/', [UsersController::class, 'store'])->name('web.users.store');
                    Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('web.users.edit');
                    Route::put('/{id}', [UsersController::class, 'update'])->name('web.users.update');
                    Route::delete('/{id}', [UsersController::class, 'destroy'])->name('web.users.delete');
                });

                Route::group(['prefix' => 'asrama'], function () {
                    Route::get('/', [AsramaController::class, 'index'])->name('web.asrama.index');
                    Route::get('/create', [AsramaController::class, 'create'])->name('web.asrama.create');
                    Route::post('/', [AsramaController::class, 'store'])->name('web.asrama.store');
                    Route::get('/{id}/edit', [AsramaController::class, 'edit'])->name('web.asrama.edit');
                    Route::get('/{id}/show', [AsramaController::class, 'show'])->name('web.asrama.show');
                    Route::put('/{id}', [AsramaController::class, 'update'])->name('web.asrama.update');
                    Route::delete('/{id}', [AsramaController::class, 'destroy'])->name('web.asrama.delete');
                });
                Route::group(['prefix' => 'room-type'], function () {
                    Route::get('/', [RoomTypeController::class, 'index'])->name('web.room-type.index');
                    Route::get('/create', [RoomTypeController::class, 'create'])->name('web.room-type.create');
                    Route::post('/', [RoomTypeController::class, 'store'])->name('web.room-type.store');
                    Route::get('/{id}/edit', [RoomTypeController::class, 'edit'])->name('web.room-type.edit');
                    Route::get('/{id}/show', [RoomTypeController::class, 'show'])->name('web.room-type.show');
                    Route::put('/{id}', [RoomTypeController::class, 'update'])->name('web.room-type.update');
                    Route::delete('/{id}', [RoomTypeController::class, 'destroy'])->name('web.room-type.delete');
                });
                Route::group(['prefix' => 'room'], function () {
                    Route::get('/', [RoomController::class, 'index'])->name('web.room.index');
                    Route::get('/create', [RoomController::class, 'create'])->name('web.room.create');
                    Route::post('/', [RoomController::class, 'store'])->name('web.room.store');
                    Route::get('/{id}/edit', [RoomController::class, 'edit'])->name('web.room.edit');
                    Route::get('/{id}/show', [RoomController::class, 'show'])->name('web.room.show');
                    Route::put('/{id}', [RoomController::class, 'update'])->name('web.room.update');
                    Route::delete('/{id}', [RoomController::class, 'destroy'])->name('web.room.delete');
                });
                Route::group(['prefix' => 'fasilitas'], function () {
                    Route::get('/', [FasilitasController::class, 'index'])->name('web.fasilitas.index');
                    Route::get('/create', [FasilitasController::class, 'create'])->name('web.fasilitas.create');
                    Route::post('/', [FasilitasController::class, 'store'])->name('web.fasilitas.store');
                    Route::get('/{id}/edit', [FasilitasController::class, 'edit'])->name('web.fasilitas.edit');
                    Route::get('/{id}/show', [FasilitasController::class, 'show'])->name('web.fasilitas.show');
                    Route::put('/{id}', [FasilitasController::class, 'update'])->name('web.fasilitas.update');
                    Route::delete('/{id}', [FasilitasController::class, 'destroy'])->name('web.fasilitas.delete');
                });

                Route::get('/pesanan', [PesananController::class, 'index'])->name('web.pesanan.index');
                Route::get('/pesanan/{id}/edit', [PesananController::class, 'edit'])->name('web.pesanan.edit');
                Route::put('/pesanan/{id}', [PesananController::class, 'update'])->name('web.pesanan.update');
                Route::get('/pesanan/{id}/verifikasi', [PesananController::class, 'verifikasi'])->name('web.pesanan.verifikasi');
                Route::get('/pesanan/{id}/cancel', [PesananController::class, 'rejected'])->name('web.pesanan.canceled');
                Route::get('/pesanan/{id}/delete', [PesananController::class, 'destroy'])->name('web.pesanan.destroy');

                Route::get('/pesanan-saya', [PesananController::class, 'index'])->name('web.pesanan-saya.index');

            });
        });
