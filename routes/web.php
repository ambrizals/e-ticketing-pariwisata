<?php

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


Route::get('/','halamanController@index')->name('front.dashboard');
Route::get('/wahana/{id}','wahanaController@detailWahana')->name('front.wahana.detail');
Route::get('/katalog','wahanaController@katalog')->name('front.wahana.katalog');
Route::namespace('admin')->group(function () {
    Route::group(['prefix' => 'manageoff', 'middleware' => ['is_management']], function () {
        Route::get('/', function(){
            return view('admin.dashboard');
        })->name('admin.dashboard');
        Route::group(['prefix' => 'master'], function () {
            Route::resource('bank','bankController');
            Route::resource('user','userController');
            Route::group(['prefix' => 'user'], function () {
                Route::put('{id}/updatepw', 'userController@updatePassword')->name('user.updatepassword');            
            });
        });
        Route::group(['prefix' => 'transaksi'], function() {
            Route::get('/','transaksiController@index')->name('transaksi.index');
            Route::get('/{id}','transaksiController@show')->name('transaksi.show');
            Route::post('payCOD/{id}','transaksiController@payCOD')->name('transaksi.paycod');
            Route::post('payTransfer/{id}','transaksiController@payTransfer')->name('transaksi.paycash');
        });
        Route::resource('pengunjung','PengunjungController');
        Route::resource('karyawan', 'karyawanController');
        Route::resource('wahana','wahanaController');
        Route::group(['prefix' => 'wahana'], function(){
            Route::post('uploadgambar/{id}', 'wahanaController@uploadGambar')->name('wahana.upload.gambar');
            Route::get('gambar/{id}','wahanaController@gambarWahana')->name('wahana.daftar.gambar');
            Route::delete('{wahana}/gambar/{id}','WahanaController@deletegambar')->name('wahana.delete.gambar');
            Route::get('{wahana}/gambar/{id}/show','wahanaController@ambilGambar')->name('wahana.gambar.show');
            Route::delete('{wahana}/deletegambar', 'wahanaController@deleteAllGambar')->name('wahana.gambar.deleteall');
        });
        Route::group(['prefix' => 'api'], function () {
            Route::get('tabelPengunjung', 'PengunjungController@daftarPengunjung')->name('api.admin.tabelpengunjung');
            Route::get('tabelKaryawan', 'KaryawanController@daftarKaryawan')->name('api.admin.tabelkaryawan');
            Route::get('tabelWahana','wahanaController@daftarWahana')->name('api.admin.daftarwahana');
            Route::get('tabelTransaksi','transaksiController@tableTransaksi')->name('api.admin.daftartransaksi');
            Route::get('tabelBank','bankController@tableBank')->name('api.admin.daftarbank');
            Route::get('tabelUser','userController@tableUser')->name('api.admin.daftaruser');
        });
        Route::get('profile', 'ProfileController@show')->name('admin.profile');
        Route::post('profile','ProfileController@store')->name('admin.profile.store');
        Route::put('profile/{id}','ProfileController@update')->name('admin.profile.update');
        Route::post('profile/pw/{id}','ProfileController@passwordChange')->name('admin.profile.changepw');
    });
});
// Route::get('sms/send', 'halamanController@sms');
Route::group(['middleware' => ['pengunjungOnly']], function () {
    Route::resource('cart','cartController');
    Route::group(['prefix' => 'akun'], function () {
        Route::get('panel','ProfileController@show')->name('front.profile.panel');
        Route::post('panel','ProfileController@store')->name('front.profile.store');

        Route::group(['middleware' => 'userPengunjung'], function() {
            Route::post('changepw/{id}', 'ProfileController@passwordChange')->name('front.profile.changepw');
            Route::put('panel','ProfileController@update')->name('front.profile.update');
            Route::group(['prefix' => 'transaction'], function () {
                Route::get('/','ProfileController@transaction')->name('front.transaction.list');
                Route::get('/{id}','transaksiController@show')->name('front.transaction.show');
                Route::post('/','transaksiController@store')->name('front.transaction.store');
                Route::get('confirmTransfer/{id}','transaksiController@form_confirmTransfer')->name('front.transaction.confirm.submit');
                Route::post('confirmTransfer/{id}','transaksiController@confirmTransfer')->name('front.transaction.confirm.store');
            });
        });
    });
});

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
