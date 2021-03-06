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



Route::get('/tes','analisaTopsis@get_positif_distance'); 
Route::get('/tes2',function(){
    $users = DB::table('mahasiswa')->select(DB::raw('SUM(prestasi) as jumlah'))->first();
    return $users->jumlah;
});
Route::group(['as' =>'admin.','middleware'=> 'auth'],function(){
    Route::get('/', function () {
        $data['mahasiswa'] = count(\App\Model\Mahasiswa::all());
        $data['fh'] = count(\App\Model\Mahasiswa::where('fakultas','FH')->get());
        $data['fkip'] = count(\App\Model\Mahasiswa::where('fakultas','FKIP')->get());
        $data['fai'] = count(\App\Model\Mahasiswa::where('fakultas','FAI')->get());
        $data['ft'] = count(\App\Model\Mahasiswa::where('fakultas','FT')->get());
        $data['fisip'] = count(\App\Model\Mahasiswa::where('fakultas','FISIP')->get());
        $data['fpik'] = count(\App\Model\Mahasiswa::where('fakultas','FPIK')->get());
        $data['fik'] = count(\App\Model\Mahasiswa::where('fakultas','FIK')->get());
        $data['fe'] = count(\App\Model\Mahasiswa::where('fakultas','FE')->get());
        return view('admin.dashboard',$data);
    });
    Route::get('/amahasiswa', function () {
        return view('admin.mahasiswa.index');
    });
    Route::get('/asetting', function () {
        $options = \App\Model\Setting::getAllKeyValue();
        return view('admin.setting',$options);
    });
    Route::get('/avariabel_linguistik', function () {
        return view('admin.topsis.variabel_linguistik');
    });
    Route::get('/abilangan_fuzzy', function () {
        return view('admin.topsis.bilangan_fuzzy');
    });
    Route::get('/amatriks_keputusan_ternormalisasi', function () {
        return view('admin.topsis.matriks_keputusan_ternormalisasi');
    });
    Route::get('/amatriks_keputusan_terbobot', function () {
        return view('admin.topsis.matriks_keputusan_terbobot');
    });
    Route::get('/ajarak_solusi_positif', function () {
        return view('admin.topsis.jarak_solusi_positif');
    });
    Route::get('/ajarak_solusi_negatif', function () {
        return view('admin.topsis.jarak_solusi_negatif');
    });
    Route::get('/anilai_preferensi', function () {
        return view('admin.topsis.nilai_preferensi');
    });
    Route::get('/ahasil_rekomendasi', function () {
        return view('admin.topsis.hasil_rekomendasi');
    });
    Route::get('/amatriks_solusi_ideal','analisaTopsis@matriks_solusi_ideal');

    Route::group(['prefix' => 'admin'], function(){
        Route::group(["as" => "mahasiswa.", "prefix" => "mahasiswa"], function () {
            Route::get('/', 'mahasiswaController@index')->name('index');
            Route::get('/data', 'mahasiswaController@data')->name('data');
            Route::post('/add', 'mahasiswaController@store')->name('add');
            Route::post('/edit', 'mahasiswaController@edit')->name('edit');
            Route::post('/delete', 'mahasiswaController@delete')->name('delete');
        });
        Route::group(["as" => "topsis.", "prefix" => "topsis"], function () {
            Route::get('/variabel_linguistik', 'analisaTopsis@variabel_linguistik')->name('linguistik');
            Route::get('/bilangan_fuzzy', 'analisaTopsis@bilangan_fuzzy')->name('fuzzy');
            Route::get('/matriks_keputusan_ternormalisasi', 'analisaTopsis@matriks_keputusan_ternormalisasi')->name('ternormalisasi');
            Route::get('/matriks_keputusan_terbobot', 'analisaTopsis@matriks_keputusan_terbobot')->name('terbobot');
            Route::get('/jarak_solusi_positif', 'analisaTopsis@jarak_solusi_positif')->name('positif');
            Route::get('/jarak_solusi_negatif', 'analisaTopsis@jarak_solusi_negatif')->name('negatif');
            Route::get('/nilai_preferensi', 'analisaTopsis@nilai_preferensi')->name('preferensi');

            
        });
        Route::group(["as" => "setting.", "prefix" => "setting"], function () {
            Route::post('/bobot', 'settingController@bobot')->name('bobot');            
        });
    });

});
Route::get('/masuk',function(){
    return view('admin.login');
}); 
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
