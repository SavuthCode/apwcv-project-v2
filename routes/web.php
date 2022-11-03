<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('locale/{locale}',function ($locale)
{
    Session::put('locale',$locale);
    return redirect()->back();
});


Route::group(['prefix','middleware' => ['auth', 'active']], function() {
    Route::get('language_switch/{locale}', [LanguageController::class, 'switchLanguage']);
    Route::get('/admin', [HomeController::class, 'index'])->name('admin');;
    Route::group(['middleware'=>['auth', 'administrator']],function(){
        Route::controller(MediaController::class)->group(function(){
            Route::get('media/index', 'index')->name('media.index');
            Route::post('media/data', 'data')->name('media.data');
            Route::post('media/store', 'store')->name('media.store');
            Route::post('media/import', 'import')->name('media.import');
            Route::get('media/video', 'video')->name('media.video');
            Route::get('media/image', 'image')->name('media.image');
            Route::get('media/{id}', 'show')->name('media.show');
            Route::put('media/{id}', 'update')->name('media.update');
            Route::delete('media/{id}', 'destroy')->name('media.destroy');
            Route::get('media/{id}/edit', 'edit')->name('media.edit');
        });

        Route::put('user/changepass/{id}', [UserController::class, 'changePassword'])->name('user.password');
        Route::get('user/genpass', [UserController::class, 'generatePassword']);
        Route::post('user/deletebyselection', [UserController::class, 'deleteBySelection']);
        Route::resource('user', UserController::class);

        Route::get('role/permission/{id}', [RoleController::class, 'permission'])->name('role.permission');
        Route::post('role/set_permission', [RoleController::class, 'setPermission'])->name('role.setPermission');
        Route::resource('role', RoleController::class);

        Route::post('importpermission', [PermissionController::class, 'importBrand'])->name('permission.import');
        Route::post('permission/deletebyselection', [PermissionController::class, 'deleteBySelection']);
        Route::post('/permission/permission-data', [PermissionController::class, 'permissionData']);
        Route::resource('permission', PermissionController::class);


        Route::get('user/profile/{id}', [UserController::class, 'profile'])->name('user.profile');
        Route::put('user/update_profile/{id}', [UserController::class, 'profileUpdate'])->name('user.profileUpdate');

        Route::get('setting/general_setting', [SettingController::class, 'generalSetting'])->name('setting.general');
        Route::post('setting/general_setting_store', [SettingController::class, 'generalSettingStore'])->name('setting.generalStore');
        Route::get('backup', [SettingController::class, 'backup'])->name('setting.backup');
        Route::get('setting/general_setting/change-theme/{theme}', [SettingController::class, 'changeTheme']);

        Route::post('employees/deletebyselection', [EmployeeController::class, 'deleteBySelection']);
        Route::resource('employees', EmployeeController::class);

        Route::post('status', [BannerController::class, 'status'])->name('status');
        Route::post('importbanner', [BannerController::class, 'importBanner'])->name('banner.import');
        Route::post('banner/deletebyselection', [BannerController::class, 'deleteBySelection']);
        Route::post('/banner/banner-data', [BannerController::class, 'bannerData']);
        Route::resource('banners', BannerController::class);

        Route::get('category-status-update/{id}/{is_active}', [CategoryController::class, 'status'])->name('category-status-update');
        Route::post('category/import', [CategoryController::class, 'import'])->name('category.import');
        Route::post('category/deletebyselection', [CategoryController::class, 'deleteBySelection']);
        Route::post('category/data', [CategoryController::class, 'categoryData'])->name('category.data');
        Route::resource('category', CategoryController::class);

        Route::resource('contacts', ContactController::class);

        Route::post('importimage', [ImageController::class, 'importBrand'])->name('image.import');
        Route::post('image/deletebyselection', [ImageController::class, 'deleteBySelection']);
        Route::post('/image/data', [ImageController::class, 'data'])->name('image.data');
        Route::post('imageProduct', [ImageController::class, 'imageProduct'])->name('imageProduct');
        Route::resource('image', ImageController::class);

        Route::post('importvideo', [VideoController::class, 'importVideo'])->name('video.import');
        Route::post('video/deletebyselection', [VideoController::class, 'deleteBySelection']);
        Route::post('/video/data', [VideoController::class, 'data'])->name('video.data');
        Route::resource('video', VideoController::class);

    });

});


