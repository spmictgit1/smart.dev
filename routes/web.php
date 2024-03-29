<?php
//ASAL//
use App\Product; //
use Illuminate\Http\Request;//
use Illuminate\Support\Facades\Route;//tmbh filter

use App\Http\Controllers\PDFController;


Auth::routes(['register' => false]);

Route::get('/', function(){
    return redirect('/admin/home');
});
// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.patch.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
   // Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home', 'DashboardController@calculation')->name('home');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
});

Route::get          ('senaraisekolah.url', 'DatasekolahsController@index')->name('senaraisekolah.name');
Route::post         ('aliransimpan.url', 'DatasekolahsController@aliransimpan')->name('aliransimpan_kaa.name');
Route::get          ('quotasekolahkaa.url', 'DatasekolahsController@quotasekolah_kaa')->name('quotasekolah_kaa.name');
Route::get          ('quotasekolahdini.url', 'DatasekolahsController@quotasekolah_dini')->name('quotasekolah_dini.name');
Route::get          ('quotasekolahtahfiz.url', 'DatasekolahsController@quotasekolah_tahfiz')->name('quotasekolah_tahfiz.name');
Route::post         ('bilquotakaa.url', 'DatasekolahsController@bilquotasimpan_kaa')->name('bilquota_kaa.name');
Route::post         ('bilquotasabkdini.url', 'DatasekolahsController@bilquotasimpan_sabk_dini')->name('bilquota_sabk_dini.name');
Route::post         ('bilquotasabktahfiz.url', 'DatasekolahsController@bilquotasimpan_sabk_tahfiz')->name('bilquota_sabk_tahfiz.name');
Route::get          ('paparmuridisi.url', 'DatasekolahsController@papar_murid_isi')->name('murid_isi.name');


Route::resource ('datamurids', 'DatamuridsController')->middleware('auth');
Route::post   ('datamurids_mass_update', 'DatamuridsController@massUpdate')->name('datamurids.mass_update')->middleware('auth');
Route::post   ('padampenempatan', 'DatamuridsController@padampenempatan')->name('datamurids.padampenempatan')->middleware('auth');

Route::get('paparcalon.url', 'DatamuridsController@paparcalon')->name('paparcalon.name');
//Route::get('searchfilter','DatamuridsController@cari')->name('searchfilter')->middleware('auth');
Route::get('filter', 'DatamuridsController@filter')->name('filter')->middleware('auth');
Route::get('markah', 'MarkahController@markah')->name('markah');

Route::post('searchfilter','TapisController@cari')->name('searchfilter')->middleware('auth');

Route::post('jana.url','DatamuridsController@massjana')->name('jana.name');
Route::get('janakodppd.url','DatamuridsController@janakodppd')->name('janakodppd.name')->middleware('auth');
Route::get('janarayuan.url','DatamuridsController@janarayuan')->name('janarayuan.name')->middleware('auth');

Route::resource ('pengesahansekolah', 'PengesahanController')->middleware('auth');
Route::post('sahterima.url', 'PengesahanController@massupdatesah')->name('sahterima.name');
Route::delete('sahterimadelete.url', 'PengesahanController@sahterimadelete')->name('sahterimadelete.name');    

Route::get('semak','SemakanController@semak')->name('semak')->middleware('guest');
Route::post('search','SemakanController@cari')->name('search')->middleware('guest'); 
//Route::get('surat_tawaran-pdf/{nokp}/{nama}/{penempatan}/{aliran}/{notel}/{ALAMATMURID}/{BANDAR}/{POSKOD}/{NEGERI}',[PDFController::class, 'generateSurat'])->middleware('guest');
Route::get('surat_tawaran-pdf/{nokp}/{notel}',[PDFController::class, 'generateSurat'])->middleware('guest');



Route::post('rayuan.url','RayuanController@simpan_rayuan')->name('rayuan.name')->middleware('guest');
//Route::get('semakrayuan','SemakanController@semakrayuan')->name('semakrayuan')->middleware('guest');
Route::get('selesairayuan','RayuanController@selesairayuan')->name('selesairayuan')->middleware('guest');
Route::get('generate-pdf', [PDFController::class, 'generatePDF'])->middleware('guest');


Route::get('dashboard','DashboardController@calculation')->name('dashboard');

Route::get('query','DashboardController@query');

Route::post('/statuses', 'StatusController@store')->name('statuses.store');
Route::get('/rayuan', 'RayuanController@rayuan')->name('rayuan');

Route::get('downloadrayuan','DatamuridsController@downloadData')->name('downloadrayuan.name');
Route::post('/upload-csv','DatamuridsController@uploadCsv');
