<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pet;
use App\Models\User;
use App\Models\PetType;
use App\Models\PetBreed;
use App\Models\Clinic;
use App\Models\Veterinary;
use App\Models\user_account;
use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Types\StringType;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use UxWeb\SweetAlert\SweetAlert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


use function PHPUnit\Framework\isFalse;
use function PHPUnit\Framework\isTrue;

class VeterinariansController extends Controller
{
     
    // retrieve data for customers 

    final function getAllCustomer(){

        $customers = Customer::select('customers.*', DB::raw("CONCAT(customer_fname, ' ', customer_lname) AS customer_name"), DB::raw("CONCAT(customer_blk,' / ', customer_street,' / ', customer_subdivision,' / ',
                                       customer_barangay,' / ',customer_city,' / ', customer_zip) AS customer_address"))
                                       ->orderBy('customer_id', 'DESC')
                                       ->paginate(8);

        
        // DB::table('customers')
        // ->select('customer_id','customer_fname','customer_lname', DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"),'customer_mobile', 'customer_tel', 
        // 'customer_gender','customer_DP','customer_birthday','customer_blk','customer_street','customer_subdivision','customer_barangay',
        // 'customer_city','customer_zip', DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
        // customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"), 'user_id', 'customer_isActive')->orderBy('customer_id', 'DESC')
        // ->paginate(5);

        return view('veterinary/viewvetcustomer', compact('customers'));
    }
    //-> end for retrieve data customers

    final function veterinariesInfo(){
        
        $veterinaries = DB::table('veterinary')
        ->join('clinic','clinic.clinic_id','=','veterinary.vet_id')
        ->select('veterinary.vet_id', DB::raw("CONCAT(vet_fname,' ', vet_lname) AS vet_name"),
        'veterinary.vet_mobile','veterinary.vet_tel','veterinary.vet_birthday','veterinary.vet_DP', DB::raw("CONCAT(vet_blk, ' ', vet_street,' ',vet_subdivision,' ',vet_barangay,' ',
        vet_city,' ',vet_zip) AS vet_address"),'veterinary.vet_dateAdded','clinic.clinic_name','veterinary.vet_isActive')
        ->paginate(10);
       

        return view('veterinary/viewvet', ['veterinaries'=>$veterinaries]);
    }

    final function clinicInfo(){
        $clinics = DB::table('clinic')
        ->select('clinic_id','clinic_name','owner_name','clinic_mobile','clinic_email','clinic_tel',
        DB::raw("CONCAT(clinic_blk,' ', clinic_street,' ',clinic_barangay,' ',clinic_city,' ',
        clinic_zip) AS clinic_address"),'clinic_isActive')
        ->paginate(15);

        return view('veterinary.viewvetclinic',['clinics'=>$clinics]);
    }

    final function retrieveInfo(){
        
    //--> retrieve pet information to table

        $petInfoDatas = Pet::select('pets.*','pet_types.*','pet_breeds.*','customers.*','clinics.*', DB::raw("CONCAT(customer_fname,' ',customer_lname) AS customer_name"),
                                    DB::raw("CONCAT(customer_blk,' ',customer_street,' ',customer_subdivision,' ',
                                    customer_barangay,' ',customer_city, ' ', customer_zip) AS customer_address"))
                            ->join('pet_types','pet_types.id','=','pets.pet_type_id')
                            ->join('pet_breeds','pet_breeds.breed_id','=','pets.pet_breed_id')
                            ->join('customers','customers.customer_id','=','pets.customer_id')
                            ->join('clinics','clinics.clinic_id','=','pets.clinic_id')
                            ->paginate(10);

        return view('veterinary.viewvetpatient', compact('petInfoDatas'));
    //--> retrieve pet information to table
    }
    
    final function petClassification($customer_id){

        $pet_types = PetType::get(); //-> retrieve pet types
        
        $pet_breeds = PetBreed::get(); //-> retrieve breeds 

        $pet_clinics = Clinic::get(); // -> retrieve vet clinics

        $custInfo = Customer::where('customer_id', '=', $customer_id)->first(); // -> retrieve info customer

        return view('veterinary.registerpet', compact('custInfo','pet_types','pet_breeds','pet_clinics'));
    }
    public function countData(){
        $countPet = Pet::count();            //
        $countCustomers = Customer::count(); // -> retrieve dashboard info
        $countClinic = Clinic::count();       //
        return view('veterinary.vethome', compact('countPet','countCustomers','countClinic'));
    }


    function userViewPatient($customer_id){
        $Owners = DB::table('pets')
        ->join('pet_types','pet_types.id','=','pets.pet_type_id')
        ->join('pet_breeds','pet_breeds.breed_id','=','pets.pet_breed_id')
        ->join('customers','customers.customer_id','=','pets.customer_id')
        ->join('clinics','clinics.clinic_id','=','pets.clinic_id')
        ->select('pets.*','pet_types.*','customers.*','clinics.*', DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"),
        'clinic.clinic_name')
        ->where('pets.customer_id','=', $customer_id)->get();

        return view('veterinary/userviewpatient', compact('Owners'));
    }

     //<------------- ---Start of customer crud operations----------------------->//

    function addCustomer(Request $request){

        $fname = $request->customer_fname;
        $lname = $request->customer_lname;
        $mname = $request->customer_mname;

        $checkQuery = DB::table('customers')
        ->where('customer_fname','=', $fname, 'AND',
         'customer_lname','=', $lname, 'AND', 
         'customer_mname','=', $mname)->first();

        $checkcust = DB::table('customers')
        ->where('customer_fname','=', $fname)
        ->where('customer_lname','=', $lname)
        ->where('customer_mname','=', $mname)->first();

         //QUERY FOR CHECKING IF THE CUSTOMER IS ALREADY REGISTERED

        if ($checkcust) {
            return back()->with('existing','The customer is Already Exist');
        }else{

            $this->validate($request, array(
                'user_name' => "required | min:5 | max: 255 | unique:users,username,$request->user_id",
                'user_email' => "required | email | unique:users,email, $request->user_id",
            ));

            $vets = new User();
                $vets->username = $request->user_name;
                $vets->password = Hash::make($request->user_password);
                $vets->phone    = $request->user_mobile;
                $vets->email    = $request->user_email;
                $vets->usertype = 'customer';
                $vets->save();
            //INSERT QUERY FOR ACCOUNTS

            if ($vets == true) { //IF THE INSERT ACCOUNT SUCCESS
                
                $getid = DB::table('users')->where('email','=', $request->user_email)->first();
                //GET ID BY USING UNIQUE ATTRIBUTES
               
                if (is_object($getid)) {
                    
                    $toArray = (array)$getid; //CONVERT OBJECT INTO ARRAY
                    (int) $convert = implode($toArray); // CONVERT ARRAY INTO STRING

                    $cust = new Customer();
                    $cust->customer_fname = ucwords($request->customer_fname);
                    $cust->customer_lname = ucwords($request->customer_lname);
                    $cust->customer_mname = ucwords($request->customer_mname);
                    $cust->customer_mobile = $request->customer_mobile;
                    $cust->customer_tel = $request->customer_tel;
                    $cust->customer_gender = $request->customer_gender;
                    $cust->customer_birthday = $request->customer_birthday;
                    $cust->customer_DP = $request->customer_DP;
                    $cust->customer_blk = ucwords($request->customer_blk);
                    $cust->customer_street = ucwords($request->customer_street);
                    $cust->customer_subdivision = ucwords($request->customer_subdivision);
                    $cust->customer_barangay = ucwords($request->customer_barangay);
                    $cust->customer_city = ucwords($request->customer_city);
                    $cust->customer_zip = ucwords($request->customer_zip);
                    $cust->id = (int)$convert;
                    $cust->customer_isActive = 1;
                    $cust->save();

                    alert()->success('Customer has been added successfully','Created');
                    return redirect('/veterinary/customers');
                   
                }
            }  
        } 
    }


    final function veteditcustomerID($customer_id){
        $vetcust_id = DB::table('customers')->where('customer_id','=', $customer_id)->first();
        // GET ID TO RETRIEVE SPECIFIC CUSTOMER FOR VIEWVETCUSTOMER PAGE UPDATE BTN
        return view('veterinary.veteditcustomer', compact('vetcust_id'));
    }


    final function editCustomer(Request $request, $customer_id){

        DB::table('customers')
        ->where('customer_id', $customer_id)
        ->update([
            'customer_fname'=>$request->customer_fname,
            'customer_lname'=>$request->customer_lname,
            'customer_mobile'=>$request->customer_mobile,
            'customer_tel'=>$request->customer_tel,
            'customer_gender'=>$request->customer_gender,
            'customer_birthday'=>$request->customer_birthday,
            'customer_blk'=>$request->customer_blk,
            'customer_street'=>$request->customer_street,
            'customer_subdivision'=>$request->customer_subdivision,
            'customer_city'=>$request->customer_city,
            'customer_zip'=>$request->customer_zip,
        ]);//editCustomer


        return back()->with('customer_updated','Customer has been updated successfuly');
    }

    final function saveCustomer(Request $request, $customer_id){

         $NoActionQuery = Customer::where('customer_fname','=', $request->customer_fname)
        ->where('customer_lname','=', $request->customer_lname)
        ->where('customer_mname','=', $request->customer_mname)
        ->where('customer_mobile','=', $request->customer_mobile)
        ->where('customer_tel','=', $request->customer_tel)
        ->where('customer_gender','=',$request->customer_gender)
        ->where('customer_birthday','=', $request->customer_birthday)
        ->where('customer_blk','=', $request->customer_blk)
        ->where('customer_street', '=', $request->customer_street)
        ->where('customer_subdivision', '=', $request->customer_subdivision)
        ->where('customer_barangay','=', $request->customer_barangay)
        ->where('customer_city','=', $request->customer_city)
        ->where('customer_zip','=', $request->customer_zip)
        ->where('customer_isActive','=', $request->isActive)->first();

        if($NoActionQuery) {
            alert()->message('Change something to update');
            return back();
        }else{
            Customer::where('customer_id', '=', $customer_id)
            ->update(array(
                'customer_fname'=>$request->customer_fname,
                'customer_lname'=>$request->customer_lname,
                'customer_mname'=>$request->customer_mname,
                'customer_mobile'=>$request->customer_mobile,
                'customer_tel'=>$request->customer_tel,
                'customer_gender'=>$request->customer_gender,
                'customer_birthday'=>$request->customer_birthday,
                'customer_blk'=>$request->customer_blk,
                'customer_street'=>$request->customer_street,
                'customer_subdivision'=>$request->customer_subdivision,
                'customer_barangay'=>$request->customer_barangay,
                'customer_city'=>$request->customer_city,
                'customer_zip'=>$request->customer_zip,
                'customer_isActive'=>$request->isActive
            ));
            //UPDATE CUSTOMER INFO
            alert()->success('Customer has been updated Successfully','Updated');
             return redirect('/veterinary/customers');

        }
   }
    
    final function addPatients(Request $request){
        $breed = $request->pet_breed_id;
        $type = $request->pet_type_id;
        $name = $request->pet_name;

        $checkQuery = Pet::where('pet_name','=', $name, 'AND', 'pet_type_id','=', $type, 'pet_breed_id','=', $breed)->first();
        //QUERY IF THE PET IS ALREADY REGISTER

        if ($checkQuery) {
            alert()->warning('Pet is already registered in the clinic','Existing');
            return back();
        }else{

            // PET ADD VALIDATION -START
            $this->validate($request, array(
                "pet_name"=>'required',
                "pet_gender"=>'required',
                "pet_birthday"=>'required',
                "pet_notes"=>'required',
                "pet_bloodType"=>'required',
                "pet_registeredDate"=>'required',
                "pet_type_id"=>'required',
                "pet_breed_id"=>'required',
                "pet_isActive"=>'required'
            )); // PET ADD VALIDATION -END



            // INSERT PET -START
            Pet::insert([
                'pet_name'=>$request->pet_name,
                'pet_gender'=>$request->pet_gender,
                'pet_birthday'=>$request->pet_birthday,
                'pet_notes'=>$request->pet_notes,
                'pet_bloodType'=>$request->pet_bloodType,
                'pet_DP'=>$request->pet_DP,
                'pet_registeredDate'=>$request->pet_registeredDate,
                'pet_type_id'=>$request->pet_type_id,
                'pet_breed_id'=>$request->pet_breed_id,
                'customer_id'=>$request->customer_id,
                'clinic_id'=>$request->clinic_id,
                'pet_isActive'=>$request->pet_isActive,
                'pet_DP'=>$request->image
                
            ]);
            //INSERT PET -END
            
            $customer_id = $request->customer_id;
            alert()->success('Pet Patient has been registered succesfully','Registered');
            return redirect()->route('veterinary.viewpatient', ['customer_id'=> base64_encode($customer_id)]);
        }

    }

    final function deleteCustomers($customer_id){ 
        $checkPetCustomer = Pet::where('customer_id', '=', $customer_id)->first();

        if ($checkPetCustomer) {
            alert()->error('Customer has registered pets','Fail');
            return back();
        }else{
            Customer::where('customer_id', $customer_id)->delete();// DELETE CUSTOMERS
            alert()->success('Customer has been deleted succesfully','Deleted');
            return back();
        }
       
    }

    //<------------- ---End of customer crud operations----------------------->//

    
    function getPetID($pet_id){

        $editPet = Pet::where('pet_id', '=', $pet_id)->first();
        $getTypePet = PetType::get();
        $getBreedPet = PetBreed::get();
        $getClinicPet = Clinic::get();
        $getOwnerPet = Customer::get();
        
        return view('veterinary.vieweditpatient', compact('editPet', 'getTypePet', 'getBreedPet','getClinicPet','getOwnerPet'));
    }

    function savePet(Request $request, $pet_id){


    
        $customer = $request->customer_id;
        $NoActionQuery = DB::table('pets')
        ->where('pet_name','=', $request->pet_name)
        ->where('pet_gender','=', $request->pet_gender)
        ->where('pet_birthday','=', $request->pet_birthday)
        ->where('pet_notes','=', $request->pet_notes)
        ->where('pet_bloodType','=', $request->pet_bloodType)
        ->where('pet_registeredDate','=',$request->pet_registeredDate)
        ->where('pet_type_id','=', $request->pet_type_id)
        ->where('pet_breed_id','=', $request->pet_breed_id)
        ->where('customer_id', '=', $request->customer_id)
        ->where('clinic_id','=', $request->clinic_id)
        ->where('pet_isActive','=', $request->pet_isActive)
        ->first();

        if ($NoActionQuery) {
            alert()->message('Change something to update');
            return back();
        }else{

            DB::table('pets')
        ->where('pet_id', $pet_id)
        ->update([
            'pet_name'=>$request->pet_name, 
            'pet_gender'=>$request->pet_gender,
            'pet_birthday'=>$request->pet_birthday,
            'pet_notes'=>$request->pet_notes,
            'pet_bloodType'=>$request->pet_bloodType,
            'pet_registeredDate'=>$request->pet_registeredDate,
            'pet_type_id'=>$request->pet_type_id,
            'pet_breed_id'=>$request->pet_breed_id,
            'customer_id'=>$request->customer_id,
            'clinic_id'=>$request->clinic_id,
            'pet_isActive'=>$request->pet_isActive,
            'pet_DP'=>$request->image
        ]);

            $customer_id = $request->customer_id;
            alert()->success('Patients has been updated sucessfully','Success');
            return redirect()->route('veterinary.viewpatient', ['customer_id'=> base64_encode($customer_id)]);
        }
    }

    final function deletePatients($pet_id){
        DB::table('pets')->where('pet_id', $pet_id)->delete(); //DELETE PATIENTS FROM viewvetpatient OR PETS
        return back()->with('patients_deleted','Patients has been deleted sucessfully');
    }
    final function deleteCustPatients($pet_id){
        Pet::where('pet_id', $pet_id)->delete(); //DELETE PATIENTS from viewpatient OR PETS

        alert()->warning('Patients has been deleted sucessfully','Error');
        return back();
    }

    final function patientsOwnerView($customer_id){
       $PatientOwner = Pet::join('pet_types','pet_types.id','=','pets.pet_type_id')
        ->join('pet_breeds','pet_breeds.breed_id','=','pets.pet_breed_id')
        ->join('customers','customers.customer_id','=','pets.customer_id')
        ->join('clinics','clinics.clinic_id','=','pets.clinic_id')
        ->select('pets.*','pet_breeds.*','customers.*','clinics.*','pet_types.*',DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name",),DB::raw("CONCAT(customer_blk,' / ', customer_street,' / ', customer_subdivision,' / ',
        customer_barangay,' / ',customer_city,' / ', customer_zip) AS customer_address"))
        ->where('pets.customer_id','=', base64_decode($customer_id))->get();

        return view('veterinary/viewpatient', ['PatientOwner'=>$PatientOwner]);
    }

    final function QRcode($pet_id){

        $QrCodeDatas= DB::table('pets')
        ->join('pet_types','pet_types.type_id','=','pets.pet_type_id')
        ->join('pet_breeds','pet_breeds.breed_id','=','pets.pet_breed_id')
        ->join('customers','customers.customer_id','=','pets.customer_id')
        ->join('clinic','clinic.clinic_id','=','pets.clinic_id')
        ->select('pets.pet_id','pets.pet_name','pets.pet_type_id', 'pets.pet_breed_id','pets.pet_gender','pets.pet_birthday','pets.pet_notes','pets.pet_bloodType','pets.pet_registeredDate', 'pet_types.type_name',
        'pet_breeds.breed_name','pets.pet_isActive', DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"),
        'clinic.clinic_name', DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
        customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"))
        ->where('pet_id','=', $pet_id)
        ->first();

        return view('veterinary.qrcode', compact('QrCodeDatas'));

    }

    public function search(Request $request){
        
        $search = $request->get('search');
        $usersData = DB::table('pets')->where('pet_name', 'like', '%'.$search.'%')->paginate('5');
        return view('veterinary.user', compact('usersData'));
    }

    public function custSearch(Request $request){
        $search = $request->get('custsearch');
        $a = Customer::select('customers.*',DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"), DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
        customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"), 'user_id', 'customer_isActive')
                              ->where('customer_lname', 'like', '%'.$search.'%');

        $a = Customer::select('customers.*',DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"), DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
        customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"), 'user_id', 'customer_isActive')
                              ->where('customer_mname', 'like', '%'.$search.'%');

        $customers = Customer::select('customers.*',DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"), DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
        customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"), 'id', 'customer_isActive')
                              ->where('customer_fname', 'like', '%'.$search.'%')
                              ->union($a)
                              ->union($b)
                              ->paginate(8);
        
        // DB::table('customers')
        // ->select('customer_id','customer_fname','customer_lname', DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"),'customer_mobile', 'customer_tel', 
        // 'customer_gender','customer_DP','customer_birthday','customer_blk','customer_street','customer_subdivision','customer_barangay',
        // 'customer_city','customer_zip', DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
        // customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"), 'user_id', 'customer_isActive')
        // -> where('customer_fname', 'like', '%'.$search.'%')->paginate('5');
        return view('veterinary.viewvetcustomer', compact('customers'));
    }

    public function patientSearch(Request $request){
        $search = $request->get('petsearch');

        $petInfoDatas = Pet::select('pets.*','pets.*','pet_types.*','pet_breeds.*','customers.*','clinics.*', DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"),
                                    DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
                                    customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"))
                                    ->where('pet_name','LIKE', '%'.$search.'%')
                                    ->paginate(10);
        
        // DB::table('pets') 
        // ->join('pet_types','pet_types.type_id','=','pets.pet_type_id')
        // ->join('pet_breeds','pet_breeds.breed_id','=','pets.pet_breed_id')
        // ->join('customers','customers.customer_id','=','pets.customer_id')
        // ->join('clinic','clinic.clinic_id','=','pets.clinic_id')
        // ->select('pets.pet_id','pets.pet_name','pets.pet_type_id', 'pets.pet_breed_id','pets.pet_gender','pets.pet_birthday','pets.pet_notes','pets.pet_bloodType','pets.pet_registeredDate', 'pet_types.type_name',
        // 'pet_breeds.breed_name','pets.pet_isActive', DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"),
        // 'clinic.clinic_name', DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
        // customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"))
        // ->where('pet_name', 'like', '%'. $search. '%')
        // ->paginate(10);

        return view('veterinary.viewvetpatient', compact('petInfoDatas'));

    }

    public function saveProfile(Request $request, $vet_id, $user_id){

        $NoActionQueryUser = User::where('phone', '=', $request->user_mobile)
                                 ->where('username', '=', $request->user_name) // query for not changes user_account
                                 ->where('email', '=', $request->user_email)->first();

        $NoActionQueryVet = Veterinary::where('vet_fname','=', $request->vet_fname)
                                      ->where('vet_lname','=', $request->vet_lname)
                                      ->where('vet_mname','=', $request->vet_mname)
                                      ->where('vet_mobile','=', $request->vet_mobile)
                                      ->where('vet_tel','=', $request->vet_tel)
                                      ->where('vet_blk','=',$request->vet_blk)    // query for not changes veterinary
                                      ->where('vet_street','=', $request->vet_street)
                                      ->where('vet_subdivision','=', $request->vet_subdivision)
                                      ->where('vet_barangay', '=', $request->vet_barangay)
                                      ->where('vet_city', '=', $request->vet_city)
                                      ->where('vet_zip','=', $request->vet_zip)->first();

        if($NoActionQueryVet && $NoActionQueryUser) {
            alert()->message('No Changes');
            return back();  // no actions
        }
    
        User::where('id', $user_id)
            ->update([
                'username'=>$request->user_name,
                'phone'=>$request->user_mobile, // acc update query
                'email'=>$request->user_email
            ]);

        Veterinary::where('vet_id', $vet_id)
            ->update([
                'vet_fname'=>$request->vet_fname,
                'vet_lname'=>$request->vet_lname,
                'vet_mname'=>$request->vet_mname,
                'vet_mobile'=>$request->vet_mobile,
                'vet_tel'=>$request->vet_tel,
                'vet_blk'=>$request->vet_blk,         // vet info update query
                'vet_street'=>$request->vet_street,
                'vet_subdivision'=>$request->vet_subdivision,
                'vet_barangay'=>$request->vet_barangay,
                'vet_city'=>$request->vet_city,
                'vet_zip'=>$request->vet_zip
            ]);

            alert()->success('Profile Updated Successfully','Updated');
            return redirect('veterinary/profilevet');

    }

    public function changePassword(Request $request, $user_id){
        $request->validate([
            'oldpassword' => 'required | min:6 | max: 30',
            'new_pass' => 'required | min:6 | max: 30',
            'check_pass' => 'required | min:6 | max: 30 | same:new_pass',
        ]);

        $currentUser = auth()->user();
        if (Hash::check($request->oldpassword,$currentUser->password)) {
            $currentUser->update([
                'password' => Hash::make($request->new_pass)
            ]);
            alert()->success('Password successsfully updated');
            return back();
        }else{
            alert()->error('Enter valid password','Not Matched');
            return back();
        }


        // $checkOldPass = DB::table('users')->where('id','=', $user_id)->first();

        // if ($request->oldpassword == $checkOldPass->password) {

        //     DB::table('users')
        //     ->where('id', $checkOldPass->id)
        //     ->update([
        //         'password'=>$request->new_pass
        //     ]);
        //      alert()->success('Password successfully Updated', 'Password Changed');
        //      return redirect('/veterinary/profilevet');
        // }else{
        //     return back();
        // }


    }

    final function logout(){
        Auth::logout();
        return redirect('/login');
    }

    // final function showProfile(){
        
    //     return view('veterinary.profilevet');
    // }

    final function vetProfile(){
        $LoggedUserInfo = User::join('veterinaries','veterinaries.id','=', 'users.id')
        ->select('veterinaries.*','users.*')
        ->where('users.id','=', auth()->user()->id)
        ->first();

        // dd($LoggedUserInfo); die();   

        return view('veterinary.profilevet', compact('LoggedUserInfo'));
    }

    final function editProfile(){
        $LoggedUserInfo = User::join('veterinaries','veterinaries.id','=', 'users.id')
        ->select('*')
        ->where('users.id','=', auth()->user()->id)->first();

        dd($LoggedUserInfo); die();
        return view('veterinary.editprofile', compact('LoggedUserInfo'));
    }

    final function showRegisterPage(){
        return view('veterinary/registercustomer');
    }

    final function showViewPatientPage(){
        return view('veterinary/viewpatient');
    }


}