<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\NewController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Customercontroller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


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
    return view('welcome');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function() {

    Route::group(['middleware' => ['auth','admin']], function() {

        Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('dashboard');
        Route::get('/CRUDvet', [AdminController::class, 'getAllVet'])->name('vet.home');
        Route::get('/CRUDpet', [AdminController::class, 'petSearch'])->name('petsearch');
        Route::get('/CRUDpettype', [AdminController::class, 'petTypeSearch'])->name('pettypesearch');
        Route::get('/CRUDpetbreed', [AdminController::class, 'breedSearch'])->name('breedsearch');
        Route::get('/CRUDcustomers', [AdminController::class, 'customerSearch2'])->name('custsearch');
        Route::get('/CRUDclinic', [AdminController::class, 'clinicSearch'])->name('clinicsearch');
        Route::get('/CRUDusers', [AdminController::class, 'userSearch'])->name('usersearch');
        Route::get('/CRUDpettype/Add', [AdminController::class, 'addType'])->name('addtype');
        Route::post('/CRUDpettype/Add/Save', [AdminController::class, 'addPetType'])->name('addpettype'); 
        Route::get('/pet/CRUDpettype/Edit/{id}',[AdminController::class,'getTypeID']);
        Route::post('/pet/CRUDpettype/Edit/{id}/Save',[AdminController::class,'saveType']);
        Route::get('/pet/CRUDpettype/Delete/{type_id}',[AdminController::class,'deleteType'])->name('deleteType');
        Route::get('/pet/CRUDpetbreed/Add', [AdminController::class, 'viewAddBreed'])->name('addbreed'); 
        Route::post('/pet/CRUDpetbreed/Add/Save', [AdminController::class, 'AddBreed'])->name('addbreed');
        Route::get('/pet/CRUDpetbreed/Edit/{breed_id}',[AdminController::class,'getBreedID']); 
        Route::post('/pet/CRUDpetbreed/Edit/{breed_id}/Save',[AdminController::class,'saveBreed']);
        Route::get('/pet/CRUDpetbreed/Delete/{breed_id}',[AdminController::class,'deleteBreed'])->name('breed_deleted');
        Route::get('/CRUDclinic/register',[AdminController::class,'viewCLinic']);
        Route::get('/CRUDvet/{clinic_id}',[AdminController::class, 'admin_viewVetDetails'])->name('clinicvet');
        Route::get('/CRUDclinic/Edit/{clinic_id}',[AdminController::class, 'admin_EditClinic'])->name('editclinic');
        Route::post('/CRUDclinic/Edit/{clinic_id}/save',[AdminController::class,'admin_EditClinicSubmit'])->name('editclinicsubmit');
        Route::get('/CRUDclinic/delete/{clinic_id}',[AdminController::class, 'deleteClinic'])->name('deleteclinic');
        Route::get('/CRUDclinic/regVet/{clinic_id}', [AdminController::class, 'admin_AddVetID'])->name('display');
        Route::post('/CRUDclinic/regVet/save', [AdminController::class, 'admin_AddVeterinarian'])->name('addveterinarian');
        Route::get('/CRUDvet/Edit/{vet_id}',[AdminController::class, 'admin_GetVet'])->name('getvet');
        Route::post('/CRUDvet/Edit/{vet_id}/Save',[AdminController::class,'admin_EditVetDetails'])->name('editvetdetails');
        Route::get('/CRUDvet/Delete/{id}', [AdminController::class, 'admin_DeleteVets'])->name('delete');
        Route::get('/CRUDusers/Edit/{id}',[AdminController::class,'admin_GetUsers'])->name('getusers');
        Route::POST('/CRUDusers/Edit/{id}/save',[AdminController::class,'editUserDetails'])->name('edituserdetails');
        Route::get('/CRUDusers/Add', [AdminController::class, 'viewAddUser'])->name('viewadduser');
        Route::get('/CRUDusers/delete/{id}',[AdminController::class, 'admin_DeleteUsers'])->name('deleteusers');
        
        Route::POST('/CRUDusers/Add/Save',[AdminController::class,'addAdminSubmit'])->name('addadminsubmit');
        
        Route::post('/logout', [AdminController:: class, 'logout'])->name('logout');

    });
});

Route::prefix('user')->name('user.')->group(function() {

    Route::group(['middleware' => ['auth','user']], function() {

        Route::get('/dashboard', [UserController:: class, 'showDashboard'])->name('dashboard'); 
        Route::post('/logout', [UserController:: class, 'logout'])->name('logout');

    });

});

Route::prefix('vet')->name('vet.')->group(function() {

    Route::group(['middleware' => ['auth','veterinary']], function() {


    });

});

