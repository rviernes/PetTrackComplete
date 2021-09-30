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

Route::group(['middleware' => ['revalidate']], function() {
Route::get('/', function () {
    return view('auth/login');
});
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function() {

    Route::group(['middleware' => ['auth','admin','revalidate']], function() {

        Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('dashboard')->middleware('prevent')->middleware('revalidate');
        Route::get('/CRUDvet', [AdminController::class, 'getAllVet'])->name('vet.home')->middleware('prevent');
        Route::get('/CRUDpet', [AdminController::class, 'petSearch'])->name('petsearch')->middleware('prevent');
        Route::get('/CRUDpettype', [AdminController::class, 'petTypeSearch'])->name('pettypesearch')->middleware('prevent');
        Route::get('/CRUDpetbreed', [AdminController::class, 'breedSearch'])->name('breedsearch')->middleware('prevent');

        Route::get('/CRUDcustomers', [AdminController::class, 'customerSearch2'])->name('custsearch')->middleware('prevent');
        Route::get('/customerEdit/{customer_id}',[AdminController::class, 'admin_veteditcustomersID']);
        Route::post('/customerEdit/{customer_id}/save',[AdminController::class, 'admin_SaveCustomers'])->name('savecusts');
        Route::get('/viewPatient/delete/{pet_id}',[AdminController::class, 'admin_DeletePet'])->name('deletepet');
        
        Route::get('/viewPets/{customer_id}',[AdminController::class, 'admin_PatientsOwnerViews'])->name('adminPetView')->middleware('prevent');
        Route::get('/CRUDclinic', [AdminController::class, 'clinicSearch'])->name('clinicsearch')->middleware('prevent');
        Route::get('/CRUDusers', [AdminController::class, 'userSearch'])->name('usersearch')->middleware('prevent');
        Route::get('/CRUDpettype/Add', [AdminController::class, 'addType'])->name('addtype')->middleware('prevent');
        Route::post('/CRUDpettype/Add/Save', [AdminController::class, 'addPetType'])->name('addpettype')->middleware('prevent'); 
        Route::get('/pet/CRUDpettype/Edit/{id}',[AdminController::class,'getTypeID'])->middleware('prevent');
        Route::post('/pet/CRUDpettype/Edit/{id}/Save',[AdminController::class,'saveType'])->middleware('prevent');
        Route::get('/pet/CRUDpettype/Delete/{type_id}',[AdminController::class,'deleteType'])->name('deleteType')->middleware('prevent');
        Route::get('/pet/CRUDpetbreed/Add', [AdminController::class, 'viewAddBreed'])->name('addbreed')->middleware('prevent'); 
        Route::post('/pet/CRUDpetbreed/Add/Save', [AdminController::class, 'AddBreed'])->name('addbreed')->middleware('prevent');
        Route::get('/pet/CRUDpetbreed/Edit/{breed_id}',[AdminController::class,'getBreedID'])->middleware('prevent'); 
        Route::post('/pet/CRUDpetbreed/Edit/{breed_id}/Save',[AdminController::class,'saveBreed'])->middleware('prevent');
        Route::get('/pet/CRUDpetbreed/Delete/{breed_id}',[AdminController::class,'deleteBreed'])->name('breed_deleted')->middleware('prevent');
        Route::get('/CRUDclinic/register',[AdminController::class,'viewCLinic'])->middleware('prevent');
        Route::get('/CRUDvet/{clinic_id}',[AdminController::class, 'admin_viewVetDetails'])->name('clinicvet')->middleware('prevent');
        Route::get('/CRUDclinic/Edit/{clinic_id}',[AdminController::class, 'admin_EditClinic'])->name('editclinic')->middleware('prevent');
        Route::post('/CRUDclinic/Edit/{clinic_id}/save',[AdminController::class,'admin_EditClinicSubmit'])->name('editclinicsubmit')->middleware('prevent');
        Route::get('/CRUDclinic/delete/{clinic_id}',[AdminController::class, 'deleteClinic'])->name('deleteclinic')->middleware('prevent');
        Route::get('/CRUDclinic/regVet/{clinic_id}', [AdminController::class, 'admin_AddVetID'])->name('display')->middleware('prevent');
        Route::post('/CRUDclinic/regVet/save', [AdminController::class, 'admin_AddVeterinarian'])->name('addveterinarian')->middleware('prevent');
        Route::post('/clinic/CRUDclinic/addClinic/save',[AdminController::class,'admin_AddClinicSubmit'])->name('addclinicsubmit')->middleware('prevent');
        Route::get('/CRUDvet/Edit/{vet_id}',[AdminController::class, 'admin_GetVet'])->name('getvet')->middleware('prevent');
        Route::post('/CRUDvet/Edit/{vet_id}/Save',[AdminController::class,'admin_EditVetDetails'])->name('editvetdetails')->middleware('prevent');
        Route::get('/CRUDvet/Delete/{id}', [AdminController::class, 'admin_DeleteVets'])->name('delete')->middleware('prevent');
        Route::get('/CRUDusers/Edit/{id}',[AdminController::class,'admin_GetUsers'])->name('getusers')->middleware('prevent');
        Route::POST('/CRUDusers/Edit/{id}/save',[AdminController::class,'editUserDetails'])->name('edituserdetails')->middleware('prevent');
        Route::get('/CRUDusers/Add', [AdminController::class, 'viewAddUser'])->name('viewadduser')->middleware('prevent');
        Route::get('/CRUDusers/delete/{id}',[AdminController::class, 'admin_DeleteUsers'])->name('deleteusers')->middleware('prevent');
        Route::get('/adminEditPatient/{pet_id}',[AdminController::class, 'admin_getPetID']);
        Route::post('/adminEditPatient/{pet_id}/save',[AdminController::class,'admin_savePetVet'])->name('pets.savepetvet');
        Route::get('/custdel/{customer_id}/delete',[AdminController::class, 'admin_DeleteCustomer2']); 

        
        Route::POST('/CRUDusers/Add/Save',[AdminController::class,'addAdminSubmit'])->name('addadminsubmit')->middleware('prevent');
        
        Route::post('/logout', [AdminController:: class, 'logout'])->name('logout')->middleware('prevent')->middleware('revalidate');

    });
});

Route::prefix('user')->name('user.')->group(function() {

    Route::group(['middleware' => ['auth','user']], function() {

        Route::get('/dashboard', [UserController:: class, 'showDashboard'])->name('dashboard'); 
        Route::post('/logout', [UserController:: class, 'logout'])->name('logout');
        Route::get('/custprofile', [UserController::class, 'userProfile']);

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

