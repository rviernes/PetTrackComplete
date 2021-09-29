<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\NewController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Customercontroller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeterinariansController;


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
    return view('auth/login');
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
        Route::post('/clinic/CRUDclinic/addClinic/save',[AdminController::class,'admin_AddClinicSubmit'])->name('addclinicsubmit');
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

Route::prefix('veterinary')->name('veterinary.')->group(function() {
    
    Route::group(['middleware' => ['auth','veterinary']], function() {
        

        Route::get('/dashboard', [VeterinariansController::class, 'countData'])->name('dashboard');
        Route::get('/customers',[VeterinariansController::class, 'getAllCustomer'])->name('getallcustomer');
        Route::get('/custsearch',[VeterinariansController::class, 'custSearch'])->name('custsearch');
        Route::get('/viewvetpatient',[VeterinariansController::class, 'retrieveInfo'])->name('retrieveInfo');
        Route::post('/viewvetpatient/save',[VeterinariansController::class, 'addPatients'])->name('addpatient');
        Route::get('/profilevet', [VeterinariansController::class, 'vetProfile']); //get session for veterinary to profilevet page
        Route::get('/editprofile', [VeterinariansController:: class, 'editProfile']); // get session update for vet
        Route::post('/editprofile/{vet_id}/{user_id}', [VeterinariansController::class, 'saveProfile'])->name('save.vetimage');
        Route::get('/registerCustomer', [VeterinariansController::class, 'showRegisterPage'])->name('vetPage');
        Route::post('/registercustomer/save', [VeterinariansController::class, 'addCustomer'])->name('addcustomer');
        Route::get('/viewpatient', [VeterinariansController::class, 'showViewPatientPage'])->name('showviewpatient');
        Route::get('/viewpatient/{customer_id}', [VeterinariansController::class, 'patientsOwnerView'])->name('viewpatient');
        Route::get('/veteditcustomer/{customer_id}',[VeterinariansController::class, 'veteditcustomerID']);
        Route::post('/save_customer/{customer_id}',[VeterinariansController::class, 'saveCustomer'])->name('vet.savecust');
        Route::get('/registerpet/{customer_id}',[VeterinariansController::class, 'petClassification']);
        Route::post('/viewvetpatient',[VeterinariansController::class, 'addPatients'])->name('addpatient');
        Route::get('/vieweditpatient/{pet_id}',[VeterinariansController::class, 'getPetID']);
        Route::post('/vieweditpatient-save/{pet_id}',[VeterinariansController::class, 'savePet']);
        Route::get('/delete-custpatitent/{pet_id}',[VeterinariansController::class, 'deleteCustPatients'])->name('deletecustpatients');
        Route::get('/delete-viewvetcustomer/{customer_id}',[VeterinariansController::class, 'deleteCustomers'])->name('deletecustomers');

        Route::post('/changepass/{user_id}/save',[VeterinariansController::class, 'changePassword'])->name('changepassword');
        
        


        Route::get('/veterinary/editaccount/{user_id}',[VeterinariansController::class, 'editAccount'])->name('vet.editaccount');

        Route::get('/veterinary/viewveteditpatient/{pet_id}',[VeterinariansController::class, 'getPetIDVet']);
        Route::post('/veterinary/viewveteditpatient-save/{pet_id}',[VeterinariansController::class, 'savePetVet']);
        
        Route::get('/veterinary/usereditcustomer/{customer_id}',[VeterinariansController::class, 'editcustomerID']);
        
        Route::get('/petsearch',[VeterinariansController::class, 'patientSearch'])->name('patientsearch');
        Route::post('/veterinary/registercustomer', [VeterinariansController::class, 'addCustomer'])->name('vet.addcustomer');
        Route::get('/veterinary/viewvetcustomer',[VeterinariansController::class, 'getAllCustomer'])->name('vet.getallcustomer');
        Route::get('/veterinary/delete-viewvetpatient/{pet_id}',[VeterinariansController::class, 'deletePatients'])->name('vet.deletepatients');
        Route::post('/veterinary/edit-viewvetcustomer/{customer_id}', [VeterinariansController::class, 'editCustomer'])->name('vet.editcust');
        Route::get('/veterinary/profilevet', [MainController::class, 'vetProfile']); //get session for veterinary to profilevet page
        Route::get('/veterinary/editprofile', [MainController:: class, 'editProfile']); // get session update for vet
        Route::get('/veterinary/viewpatient/{customer_id}',[VeterinariansController::class, 'patientsOwnerView'])->name('custownerpatient');
        Route::get('/veterinary/userviewpatient/{customer_id}',[VeterinariansController::class, 'userViewPatient']);
        Route::get('/veterinary/clinicvet/{clinic_id}',[VeterinariansController::class, 'viewClinicVets']);
        Route::get('/veterinary/qrcode/{pet_id}',[VeterinariansController::class, 'QRcode'])->name('vet.qrcode');

        
        Route::post('/logout', [VeterinariansController:: class, 'logout'])->name('logout');
        
    });

});

