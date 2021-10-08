<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vets;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Clinic;
use App\Models\PetBreed;
use App\Models\Pet;
use App\Models\PetType;
use App\Models\UserType;
use App\Models\Veterinary;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User_accounts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Types\StringType;
use UxWeb\SweetAlert\SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
    function showDashboard(){
        $countVeterinarians = DB::table('veterinaries')->count();
        $countPet = Pet::count();
        $countCustomers = Customer::count();
        $countClinic = Clinic::count();
        return view('admin.dashboard', compact('countVeterinarians','countPet','countCustomers','countClinic'));
    }

    final function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function admin_CountData(){
        $countVeterinarians = DB::table('veterinaries')->count();
        $countPet = Pet::count();
        $countCustomers = Customer::count();
        $countClinic = Clinic::count();

        return view('admin.dashboard', compact('countVeterinarians','countPet','countCustomers','countClinic'));
    }

    final function addType(){
        return view('admin.pet.CRUDaddtype');
    }

    function getAllVet(){
        $admin_Veterinary = DB::table('veterinaries')
        ->join('clinics', 'veterinaries.clinic_id', '=', 'clinics.clinic_id')
        ->join('users', 'veterinaries.id', '=','users.id')
        ->select('veterinaries.*', 'clinics.*', 'users.*', DB::raw("CONCAT(vet_blk,'/', vet_street,'/', vet_subdivision,'/', vet_barangay,' ',vet_city,' ', vet_zip) AS vet_address"))->paginate(8);
        //inner join clinic

        $pet_clinics = DB::table('clinics')->get();

        $users = DB::table('users')->where('usertype','=','customer')->get();

        $pet_types = DB::table('pet_types')->get();

        $pet_breeds = DB::table('pet_breeds')->get();

        $pet_clinics = DB::table('clinics')->get();

        

        return view('admin.vet.CRUDvet', compact('admin_Veterinary','users','pet_clinics','pet_breeds', 'pet_types'));
    }

    public function petSearch(Request $request){
        $search = $request->get('petSearch');
        $Pet = Pet::join('pet_types','pet_types.id','pets.pet_type_id')
                  ->join('pet_breeds','pet_breeds.breed_id', 'pets.pet_breed_id')
                  ->join('clinics','clinics.clinic_id', 'pets.clinic_id')
                  ->join('customers','customers.customer_id', 'pets.customer_id')
                  ->select('pet_types.*','pet_breeds.*','pets.*','clinics.*','customers.*', DB::raw("CONCAT(customer_blk,' / ', customer_street, ' / ', customer_subdivision, ' / ', customer_barangay, ' / ', customer_zip, ' / ', customer_city) AS customer_address"), DB::raw("CONCAT(customer_fname, ' ', customer_lname) AS customer_name"))
                  ->where('pet_name', 'LIKE', '%'.$search.'%')
                  ->paginate('8');
        return view('admin.pet.CRUDpet', compact('Pet'));
    }

    public function petTypeSearch(Request $request){
        $search = $request->get('petTypeSearch');
        $typePet = PetType::where('type_name', 'LIKE', '%'.$search.'%')->paginate('8');


        return view('admin.pet.CRUDpettype', compact('typePet'));
    }

    public function breedSearch(Request $request){
        $search = $request->get('breedSearch');
        $typeBreed = PetBreed::select('*')->where('breed_name', 'LIKE', '%'.$search.'%')->paginate('8');

        // if($typeBreed->isEmpty()){
        //     alert()->error('The were no possible match of what you searched','No Match Found')->persistent('close');
        //     return redirect('/admin/CRUDpetbreed');
        // }

        return view('admin.pet.CRUDpetbreed', compact('typeBreed'));
    }

    function getAllCustomers(){
        $customers = DB::table('customers')
        ->select('customer_id','customer_fname','customer_lname', DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"),'customer_mobile', 'customer_tel', 
        'customer_gender','customer_DP','customer_birthday','customer_blk','customer_street','customer_subdivision','customer_barangay',
        'customer_city','customer_zip', DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
        customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"), 'id', 'customer_isActive')->orderBy('customer_id', 'DESC')
        ->paginate(5);

        $pet_clinics = DB::table('clinics')->get();

        $users = DB::table('users')->where('userType_id','=','3')->get();

        $pet_types = DB::table('pet_types')->get();

        $pet_breeds = DB::table('pet_breeds')->get();

        $pet_clinics = DB::table('clinics')->get();

        return view('admin.customer.CRUDcustomers', compact('customers','users','pet_clinics','pet_breeds', 'pet_types'));
    }

    public function customerSearch2(Request $request){
        $search = $request->get('custsearch');

        $a = Customer::where('customer_lname', 'like', '%'.$search.'%');

        $b = Customer::where('customer_mname', 'like', '%'.$search.'%');

        $customers = Customer::where('customer_fname', 'like', '%'.$search.'%')
                             ->union($a)
                             ->union($b)
                             ->paginate(8);
        
        // DB::table('customers')
        // ->select('customer_id','customer_fname','customer_lname', DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"),'customer_mobile', 'customer_tel', 
        // 'customer_gender','customer_DP','customer_birthday','customer_blk','customer_street','customer_subdivision','customer_barangay',
        // 'customer_city','customer_zip', DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
        // customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"), 'id', 'customer_isActive')
        // -> where('customer_fname', 'like', '%'.$search.'%')
        // ->paginate('5');
        return view('admin.customer.CRUDcustomers', compact('customers'));
    }

    public function clinicSearch(Request $request){
        $search = $request->get('clinicSearch');
        $getClinicInfo = Clinic::where('clinic_name', 'LIKE', '%'.$search.'%')->paginate('5');

        return view('admin.clinic.CRUDclinic', compact('getClinicInfo'));
    }

    public function userSearch(Request $request){
        $search = $request->get('userSearch');

        $userTypes_name = User::where('username','LIKE','%'.$search.'%')->paginate(3);

        return view('admin.users.CRUDusers', compact('userTypes_name'));
    }

    function addPetType(Request $request){

        $type_name= $request->type_name;
    
        $checkQuery = DB::table('pet_types')->where('type_name','=', $type_name)->first();
        
    
        if ($checkQuery) {
            alert()->warning('Pet type name already exist!', 'Existing');
            return back();
        }else{
            if ($type_name == "") {
                alert()->warning('Input something to create!', 'Empty');
                return back();
            }else{
                DB::table('pet_types')->insert([ 'type_name'=>$request->type_name ]);
    
                alert()->success('Pet type added succesfully', 'Type Added!');
                return redirect('/admin/CRUDpettype');
            }
        }
    }

    function getTypeID($id){

        $getID = PetType::where('id','=',$id)->first();

        return view('admin.pet.CRUDedittype',compact('getID'));
    }


    function saveType(Request $request,$id){
        $type_name = $request->type_name;
        // $checkQueryExist = DB::table
        $checkQuery = DB::table('pet_types')->where('type_name','=', $type_name)->first();

        if ($checkQuery) {
            alert()->message('No changes have been applied', 'Existing');
            return back();
        }else{
            if ($type_name == "") {
                alert()->message('Input something to create', 'Empty');
                return back();
            }else{
                PetType::where('id',$id)
                        ->update([
                            'type_name'=>$request->type_name
                        ]);

                  alert()->success('Type Name Successfully Updated', 'Updated!');
                  return redirect('/admin/CRUDpettype');
            }
        }
    }

    function deleteType($id){
        $queryCheck = Pet::where('pet_type_id',$id)->first();

        if ($queryCheck) {
            alert()->error('Pet Type is in use.', 'Cannot Delete.');
            return back();
        }else{
            PetType::where('id', $id)->delete();
            alert()->warning('Pet Type Name Successfully Deleted', 'Type Name Deleted');
            return back();
        }
    }

    function viewAddBreed(){
        return view('admin.pet.CRUDaddbreed');
    }

    function addBreed(Request $request) {
        $breed_name = $request->breed_name;
    
        $checkQuery = PetBreed::where('breed_name','=', $breed_name)->first();
    
        if ($checkQuery) {
            alert()->warning('Pet breed name already exist','Already Exist');
            return back();
        }elseif ($breed_name == null) {
            alert()->message('Input something to create','Empty');
            return back();
        }else{
            $request->validate([
                'breed_name'=>'required',
            ]);
            PetBreed::insert(['breed_name'=>$request->breed_name]);
            // DB::table('pet_breeds')->insert([
            //     'breed_name'=>$request->breed_name
            // ]);
            alert()->success('Pet breed added succesfully','New Breed Name');
            return redirect('/admin/CRUDpetbreed');
        }
    }

    function getBreedID($breed_id){
        $getID = PetBreed::where('breed_id', $breed_id)->first();
        return view ('admin.pet.CRUDeditbreed',compact('getID'));
    }

    function saveBreed(Request $request,$breed_id){
        $checkQuery = PetBreed::where('breed_name','=',$request->breed_name)->first();

        if ($checkQuery) {
            alert()->warning('Breed name already exist','Already Exist');
            return back();
        }elseif ($request->breed_name == null) {
            alert()->message('Input something to create','Empty');
            return back();
        }else{
            PetBreed::where('breed_id',$breed_id)
                     ->update(['breed_name' => $request->breed_name]);

            alert()->success('Breed name successfully updated','Updated');
            return redirect('/admin/CRUDpetbreed');
        }
    }

    function deleteBreed($breed_id){
        $checkQuery = Pet::where('pet_breed_id',$breed_id)->first();

        if ($checkQuery) {
            alert()->error('Breed option is in use', 'Cannot Delete');
            return back();
        }else{
            PetBreed::where('breed_id', $breed_id)->delete();

            alert()->warning('Breed name has been deleted', 'Deleted');
            return redirect('/admin/CRUDpetbreed');
        }
        

    }

    final function admin_PatientsOwnerViews($customer_id){
        $PatientOwner = Pet::join('pet_types','pet_types.id','=','pets.pet_type_id')
                            ->join('pet_breeds','pet_breeds.breed_id','=','pets.pet_breed_id')
                            ->join('customers','customers.customer_id','=','pets.customer_id')
                            ->join('clinics','clinics.clinic_id','=','pets.clinic_id')
                            ->select('pets.pet_id','pets.pet_name','pets.pet_gender','pets.pet_birthday','pets.pet_notes','pets.pet_bloodType','pets.pet_registeredDate', 'pet_types.type_name',
         'pet_breeds.breed_name','pets.pet_isActive','pets.customer_id', DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name",),DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
         customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"),'clinics.clinic_name')
         ->where('pets.customer_id','=', $customer_id)->get();
                            
        
        // DB::table('pets')
        //  ->join('pet_types','pet_types.id','=','pets.pet_type_id')
        //  ->join('pet_breeds','pet_breeds.breed_id','=','pets.pet_breed_id')
        //  ->join('customers','customers.customer_id','=','pets.customer_id')
        //  ->join('clinics','clinics.clinic_id','=','pets.clinic_id')
        //  ->select('pets.pet_id','pets.pet_name','pets.pet_gender','pets.pet_birthday','pets.pet_notes','pets.pet_bloodType','pets.pet_registeredDate', 'pet_types.type_name',
        //  'pet_breeds.breed_name','pets.pet_isActive','pets.customer_id', DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name",),DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ',
        //  customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"),'clinic.clinic_name')
        //  ->where('pets.customer_id','=', $customer_id)->get();
 
         return view('admin.customer.viewPatient', compact('PatientOwner'));
    }

    final function admin_veteditcustomersID($customer_id){
        $vetcust_id = Customer::where('customer_id','=',$customer_id)->first();

        return view('admin.customer.customerEdit', compact('vetcust_id'));
    }


    final function admin_SaveCustomers(Request $request, $customer_id){
        $checkQuery2 = Customer::where('customer_fname','=', $request->customer_fname)
                              ->where('customer_lname', '=', $request->customer_lname)
                              ->first();
        

        $checkQuery = Customer::where('customer_fname','=',$request->customer_fname)
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
                 //  $request->validate([
                 //     'customer_fname' => "required | unique:customers,customer_fname,$request->customer_id",
                 //     'customer_lname' => "required | unique:customers,customer_lname,$request->customer_id"
                 //  ]);

                 $fname = $request->customer_fname;
                 $lname = $request->customer_lname;

                //  $namee2 = $fname.$lname;

                 $getFname = Customer::whereNotIn('customer_id', [$customer_id])->pluck('customer_fname')->first();
                 $getLname = Customer::whereNotIn('customer_id', [$customer_id])->pluck('customer_lname')->first();

                 $namee = $getFname.$getLname;

                //  $firstname = $getFname['customer_fname'];
                
                //  dd($namee2 == $namee); die();    

                 if ($fname == $getFname && $lname == $getLname)  {
                     alert()->warning('This Account Already Exist');
                     return back();
                 }
                 else {
                    if($checkQuery) {
                        alert()->message('Change something to edit');
                        return back();
                    }else{
                        DB::table('customers')
                        ->where('customer_id', '=', $customer_id)
                        ->update(array(
                            'customer_fname'=> $request->customer_fname,
                            'customer_lname'=> ucwords($request->customer_lname),
                            'customer_mname'=> ucwords($request->customer_mname),
                            'customer_mobile'=>$request->customer_mobile,
                            'customer_tel'=>$request->customer_tel,
                            'customer_gender'=>$request->customer_gender,
                            'customer_birthday'=>$request->customer_birthday,
                            'customer_blk'=> ucwords($request->customer_blk),
                            'customer_street'=> ucwords($request->customer_street),
                            'customer_subdivision'=> ucwords($request->customer_subdivision),
                            'customer_barangay'=> ucwords($request->customer_barangay),
                            'customer_city'=> ucwords($request->customer_city),
                            'customer_zip'=>$request->customer_zip,
                            'customer_isActive'=>$request->isActive
                        ));
                        //UPDATE CUSTOMER INFO
                        alert()->success('Customer Updated Successfully','Updated!');
                         return redirect('/admin/CRUDcustomers');
            
                    }       
                 }
                 
            

        
    }

    final function admin_DeleteCustomer2($customer_id){ 
        $getUserID = Customer::where('customer_id', $customer_id)->pluck('id')->first();
        $getType = User::where('id',$getUserID)->pluck('usertype')->first();
        $custID = Customer::where('id',$getUserID)->pluck('customer_id')->first();
        $custQuery = Pet::where('customer_id', $custID)->first();
        $countAdmin = User::where('usertype','admin')->count();
        // $deleteVet = DB::table('veterinary')->where('user_id', $getUserID)->delete();

        if ($custQuery) {
            alert()->error('Customer has registered pets','Delete Fail');
            return back();
        }else{
            if ($getType = 'customer') {
                Customers::where('id', $getUserID)->delete();
                User::where('id', $getUserID)->delete();

                alert()->warning('Customer successfully deleted','Deleted');
                return back();
            // }
            // elseif($getType = 2){
            //     if($deleteVet == true){
            //         DB::table('user_accounts')->where('user_id', $getUserID)->delete();
            //     }
            }else{
                if ($countAdmin>1) {
                    DB::table('users')->where('id', $getUserID)->delete();
                }else{
                    return back()->with('deleteFail2','Need 1 Administrator.');
                }
            }
        }       
        alert()->warning('User Successfully deleted','Deleted');        
        return back();
    }

    public function admin_AddClinicSubmit(Request $request){
        $checkQuery = Clinic::where('clinic_blk', $request->clinic_blk)->first();

        // dd($checkQuery2); die;

        if ($checkQuery) {
            alert()->warning('Clinic is already registered');
            return back();
        }else{
            Clinic::insert([
                'clinic_name' => ucwords($request->clinic_name),
                'owner_name' => ucwords($request->owner_name),
                'clinic_mobile' => $request->clinic_mobile,
                'clinic_tel' => $request->clinic_tel,
                'clinic_email' => $request->clinic_email,
                'clinic_blk' => ucwords($request->clinic_blk),
                'clinic_street' => ucwords($request->clinic_street),
                'clinic_barangay' => ucwords($request->clinic_barangay),
                'clinic_city' => ucwords($request->clinic_city),
                'clinic_zip' => ucwords($request->clinic_zip),
                'clinic_isActive' => $request->clinic_isActive
            ]);
            alert()->success('Clinic successfully registered!', 'Clinic Created!');
            return redirect('/admin/CRUDclinic');   
        }
    }

    function viewCLinic(){
        return view('admin.clinic.registerClinic');
    }

    function admin_viewVetDetails($clinic_id){
        $vetDetails = Veterinary::join('users', 'users.id','=','veterinaries.id')
                                ->select('veterinaries.*','users.*')->where('clinic_id','=', $clinic_id)->get();
        
        // DB::table('veterinary')
        // ->join('user_accounts', 'user_accounts.user_id','=','veterinary.user_id')
        // ->join('usertypes', 'user_accounts.userType_id','=','usertypes.userType_id')
        // ->select('veterinary.*','user_accounts.*','usertypes.*')->where('clinic_id','=', $clinic_id)->get();

        // ('vet_id','vet_fname','vet_lname',
        //     DB::raw("CONCAT(customer_fname,' ', customer_lname) AS customer_name"),'customer_mobile', 'customer_tel', 'customer_gender','customer_DP','customer_birthday','customer_blk','customer_street','customer_subdivision','customer_barangay','customer_city','customer_zip', 
        //     DB::raw("CONCAT(customer_blk,' ', customer_street,' ', customer_subdivision,' ', customer_barangay,' ',customer_city,' ', customer_zip) AS customer_address"), 'user_id', 'customer_isActive')
        // ->where('user_id', '=', $user_id)
        // ->get();

        return view('admin.vet.viewVetDetails', ['vetDetails'=>$vetDetails]);
    }

    function admin_AddVetID($clinic_id){
        $userVetID = User::select('id')->orderBy('id', 'desc')->first();

        $vetInfo = Clinic::where('clinic_id', '=', $clinic_id)->first();
        $clinicInfo = Clinic::get();

        return view('admin.vet.registerVet', compact('userVetID','vetInfo','clinicInfo'));
    }

    function admin_AddVeterinarian(Request $request){
        $username = $request->user_name;
        $password = $request->user_password;
        $email = $request->user_email;

        $fname = $request->vet_fname;
        $lname = $request->vet_lname;
        $mname = $request->vet_mname;

        $checkQuery = Veterinary::where('vet_fname','=', $fname)
                                ->Where('vet_lname', '=', $lname)
                                ->Where('vet_mname', '=', $mname)->first();
        
        $checkQuery2 = User::where('username','=', $request->user_name)
                           ->where('email','=', $request->user_email)->first();

        if ($checkQuery) {
            alert()->warning('Veterinarian already exist','Already Exist');
            return back();
        }else{
            if ($checkQuery2) {
                alert()->warning('Account already taken');
                return back();
            }
                $vets = new User();
                $vets->username    = $username;
                $vets->password    = Hash::make($password);
                $vets->phone = $request->user_mobile;
                $vets->email       = $email;
                $vets->usertype = 'veterinary';
                $vets->save();
     
                if($vets == true){
                     $getId = DB::table('users')->where('username', $request->user_name)->first();
     
                     if(is_object($getId)){

                        $toArray = (array)$getId;
                        (int) $convert = implode($toArray);

                        $vet = new Veterinary();
                        $vet->vet_fname       = ucwords($request->vet_fname);
                        $vet->vet_lname       = ucwords($request->vet_lname);
                        $vet->vet_mname       = ucwords($request->vet_mname);
                        $vet->vet_mobile      = $request->vet_mobile;
                        $vet->vet_tel         = $request->vet_tel;
                        $vet->vet_birthday    = $request->vet_birthday;
                        $vet->vet_DP          = $request->vet_DP;
                        $vet->vet_blk         = $request->vet_blk;
                        $vet->vet_street      = ucwords($request->vet_street);
                        $vet->vet_subdivision = ucwords($request->vet_subdivision);
                        $vet->vet_barangay    = ucwords($request->vet_barangay);
                        $vet->vet_city        = ucwords($request->vet_city);
                        $vet->vet_zip         = $request->vet_zip;
                        $vet->id              = (int)$convert;
                        $vet->clinic_id       = $request->clinic_id;
                        $vet->vet_isActive    = $request->vet_isActive;
                        $vet->vet_dateAdded   = $request->vet_dateAdded;
                        $vet->save();

                         $id = $request->clinic_id;
                         alert()->success('Veterinary has been Successfully added','Welcome!');
                         return redirect()->route('admin.clinicvet', ['clinic_id'=> $id]);
                        }
                 
            }
           
        }
    }

    function admin_EditClinic($clinic_id){
        $clinics = Clinic::where('clinic_id','=', $clinic_id)->first();
        return view('admin.clinic.editClinic', compact('clinics'));
    }


    public function admin_EditClinicSubmit(Request $request, $clinic_id){
        $clic_name = $request->clinic_name;
        $owner_name = $request->owner_name;
        $clinic_mobile = $request->clinic_mobile;
        $clinic_tel = $request->clinic_tel;
        $clinic_email = $request->clinic_email;
        $clinic_blk = $request->clinic_blk;
        $clinic_street = $request->clinic_street;
        $clinic_barangay = $request->clinic_barangay;
        $clinic_city = $request->clinic_city;
        $clinic_zip = $request->clinic_zip;
        $clinic_isActive = $request->clinic_isActive;

        // $clinic = new Clinic();
        // $clinic->clinic_name = $clic_name;
        // $clinic->owner_name = $owner_name;
        // $clinic->clinic_mobile = $clinic_mobile;
        // $clinic->clinic_tel = $clinic_tel;
        // $clinic->clinic_email = $clinic_email;
        // $clinic->clinic_blk = $clinic_blk;
        // $clinic->clinic_street = $clinic_street;
        // $clinic->clinic_barangay = $clinic_barangay;
        // $clinic->clinic_city = $clinic_city;
        // $clinic->clinic_zip = $clinic_zip;
        // $clinic->clinic_isActive = $clinic_isActive;
        // $clinic->save();
        
        $checkClinicQuery = Clinic::
            where('clinic_name', '=', $clic_name)
            ->where('owner_name', '=', $owner_name)
            ->where('clinic_mobile', '=', $clinic_mobile)
            ->where('clinic_tel', '=', $clinic_tel)
            ->where('clinic_email', '=', $clinic_email)
            ->where('clinic_blk', '=', $clinic_blk)
            ->where('clinic_street', '=', $clinic_street)
            ->where('clinic_barangay', '=', $clinic_barangay)
            ->where('clinic_city', '=', $clinic_city)
            ->where('clinic_zip', '=', $clinic_zip)
            ->where('clinic_isActive', '=', $clinic_isActive)->first();
        
        $checkClinicQuery2 = Clinic::whereNotIn('clinic_id', [$clinic_id])->pluck('clinic_blk')->first();

            if ($checkClinicQuery) {
                alert()->message('No changes / all are the same');
                return back();
            }else{
                if ($clinic_blk == $checkClinicQuery2) {
                    alert()->warning('A clinic already exist in that House Block/Building/Floor #', 'Error');
                    return back();
                }else{
                    Clinic::where('clinic_id', $clinic_id)
                      ->update([
                        'clinic_name' => $request->clinic_name,
                        'owner_name' => $request->owner_name,
                        'clinic_mobile' => $request->clinic_mobile,
                        'clinic_tel' => $request->clinic_tel,
                        'clinic_email' => $request->clinic_email,
                        'clinic_blk' => $request->clinic_blk,
                        'clinic_street' => $request->clinic_street,
                        'clinic_barangay' => $request->clinic_barangay,
                        'clinic_city' => $request->clinic_city,
                        'clinic_zip' => $request->clinic_zip,
                        'clinic_isActive' => $request->clinic_isActive
                      ]);
            alert()->success('Clinic has been successfully Updated','Clinic Updated');
            return redirect('/admin/CRUDclinic');
                    }
        }
    }

    final function deleteClinic($clinic_id){
        $clinicQuery2 = Pet::where('clinic_id', $clinic_id)->first();
        $clinicID = Veterinary::where('clinic_id', $clinic_id)->pluck('clinic_id')->first();
        $clinicQuery = Veterinary::where('clinic_id', $clinicID)->first();

        if($clinicQuery || $clinicQuery2){
            alert()->error('Clinic contains veterinarians/pets. Empty Clinic First', 'Fail');
            return back();
        }else{
            Clinic::where('clinic_id', $clinic_id)->delete();
            alert()->warning('clinic successfully deleted','Clinic Deleted');
            return back();
        }
    }

    function admin_GetVet($vet_id){
        $vets = Veterinary::where('vet_id','=', $vet_id)->first();

        $userVetID = User::get();

        $vetInfo = Clinic::get();

        $clinicInfo = Veterinary::get();

        return view('admin.vet.editVet', compact('vets', 'userVetID', 'vetInfo', 'clinicInfo'));
    }

    
    function admin_EditVetDetails(Request $request, $vet_id){
        $vet_fname = $request->vet_fname;
        $vet_lname = $request->vet_lname;
        $vet_mname = $request->vet_mname;
        $vet_mobile = $request->vet_mobile;
        $vet_tel = $request->vet_tel;
        $vet_birthday = $request->vet_birthday;
        $vet_blk = $request->vet_blk;
        $vet_street = $request->vet_street;
        $vet_subdivision = $request->vet_subdivision;
        $vet_barangay = $request->vet_barangay;
        $vet_city = $request->vet_city;
        $vet_zip = $request->vet_zip;
        $vet_dateAdded = $request->vet_dateAdded;
        $vet_isActive = $request->vet_isActive;

        $checkClinicQuery = Veterinary::where('vet_fname', '=', $vet_fname)
                                      ->where('vet_lname', '=', $vet_lname)
                                      ->where('vet_mname', '=', $vet_mname)
                                      ->where('vet_mobile', '=', $vet_mobile)
                                      ->where('vet_tel', '=', $vet_tel)
                                      ->where('vet_birthday', '=', $vet_birthday)
                                      ->where('vet_blk', '=', $vet_blk)
                                      ->where('vet_street', '=', $vet_street)
                                      ->where('vet_subdivision', '=', $vet_subdivision)
                                      ->where('vet_barangay', '=', $vet_barangay)
                                      ->where('vet_city', '=', $vet_city)
                                      ->where('vet_zip', '=', $vet_zip)
                                      ->where('vet_dateAdded', '=', $vet_dateAdded)
                                      ->where('vet_isActive', '=', $vet_isActive)->first();

            if ($checkClinicQuery) {
                alert()->message('No changes / all are the same', 'Update Fail');
                return back();
            }else{
                Veterinary::where('vet_id', $vet_id)
                          ->update([
                            'vet_fname'=>$request->vet_fname,
                            'vet_lname'=>$request->vet_lname,
                            'vet_mname'=>$request->vet_mname,
                            'vet_mobile'=>$request->vet_mobile,
                            'vet_tel'=>$request->vet_tel,
                            'vet_birthday'=>$request->vet_birthday,
                            'vet_blk'=>$request->vet_blk,
                            'vet_street'=>$request->vet_street,
                            'vet_subdivision'=>$request->vet_subdivision,
                            'vet_barangay'=>$request->vet_barangay,
                            'vet_city'=>$request->vet_city,
                            'vet_dateAdded'=>$request->vet_dateAdded,
                            'vet_zip'=>$request->vet_zip,
                            'vet_isActive'=>$request->vet_isActive
                          ]);
        //     DB::table('veterinary')
        //     ->where('vet_id', $vet_id)
        //     ->update(array(
        //         'vet_fname'=>$request->vet_fname,
        //         'vet_lname'=>$request->vet_lname,
        //         'vet_mname'=>$request->vet_mname,
        //         'vet_mobile'=>$request->vet_mobile,
        //         'vet_tel'=>$request->vet_tel,
        //         'vet_birthday'=>$request->vet_birthday,
        //         'vet_blk'=>$request->vet_blk,
        //         'vet_street'=>$request->vet_street,
        //         'vet_subdivision'=>$request->vet_subdivision,
        //         'vet_barangay'=>$request->vet_barangay,
        //         'vet_city'=>$request->vet_city,
        //         'vet_dateAdded'=>$request->vet_dateAdded,
        //         'vet_zip'=>$request->vet_zip,
        //         'vet_isActive'=>$request->vet_isActive
        // ));
                $clinic_id = $request->clinic_id;
                alert()->success('Vet has been updated sucessfully','Updated!');
                return redirect()->route('admin.clinicvet', ['clinic_id'=> $clinic_id]);
        }
            // return redirect('/admin/clinic/CRUDclinic/home')->with('vet_updated','Vet has been successfully Updated');
    }

    final function admin_DeleteVets($user_id){
        $getType = DB::table('users')->where('id', $user_id)->pluck('usertype')->first();
        $deleteVet = DB::table('veterinaries')->where('id', $user_id)->delete();
        
        if ($getType = 'veterinary') {
            if($deleteVet == true){
                    User::where('id', $user_id)->delete();
                    alert()->success('Veterinary Deleted', 'Thank you for your service!');
                    return back();
                }
        }
    }

    function admin_GetUsers($id){
        $users = User::where('id', $id)->first();

        $userOptions = User::select('usertype')->get();

        return view('admin.users.editUser', compact('users','userOptions'));
    }

    public function editUserDetails(Request $request){
        

        $this->validate($request, array(
            'user_name' => "required | min:5 | max: 255 | unique:users,username,$request->user_id",
            'user_email' => "required | email | unique:users,email, $request->user_id",
        ));

        $user = User::findOrFail($request->id);
        $user->username = trim($request->user_name);
        $user->email = trim($request->user_email);
        $user->save();
        
        alert()->success('User Updated Successfully','Updated');
        return redirect('/admin/CRUDusers');
    }

    function viewAddUser(){
        return view('admin.users.registerUser');
    }


    public function addAdminSubmit(Request $request){
        $checkUserQuery = User::where('username', '=', $request->user_name)
            ->where('password', '=', $request->user_password)
            ->where('phone', '=', $request->user_mobile)
            ->where('email', '=', $request->user_email)->first();

        $checkUserQuery2 = User::where('username', '=', $request->user_name)
                                ->where('email','=',$request->user_email)->first();
        $request->validate([
            'user_name'=>"unique:users,username",
            'user_email'=>"unique:users,email"
        ]);
        if ($checkUserQuery) {
            alert()->message('No Changes within the fields','Same Inputs');
            return back();
        } else {
            if ($checkUserQuery2) {
                alert()->message('Account already exists','Existing');
                return back();
            }
            User::insert([
                'username' => $request->user_name,
                'password' => Hash::make($request->user_password),
                'phone' => $request->user_mobile,
                'email' => $request->user_email,
                'usertype' => $request->userType
            ]);
        }
        alert()->success('Welcome, Admin!', 'Account Created');
        return redirect('/admin/CRUDusers')->with('user_created', 'User Created successfully!');
    }


    final function admin_DeleteUsers($user_id){
        $getType = DB::table('users')->where('id', $user_id)->pluck('usertype')->first();
        $custID = DB::table('customers')->where('id', $user_id)->pluck('customer_id')->first();
        $custQuery = DB::table('pets')->where('customer_id', $custID)->first();
        $countAdmin = DB::table('users')->select(DB::raw('COUNT(*) as count'))->where('usertype', 'veterinary')->pluck('count')->first();
        // $deleteVet = 

        // dd($countAdmin); die();

        if ($custQuery) {
            alert()->warning('Customer Has Pets!', 'Cannot Delete');
            return back();
        }else{
            if ($getType = 'customer') {
                DB::table('customers')->where('id', $user_id)->delete();
                DB::table('users')->where('id', $user_id)->delete();
            }elseif($getType = 'veterinary'){
                DB::table('veterinaries')->where('id', $user_id)->delete();
                DB::table('users')->where('id', $user_id)->delete();
            }else{
                if ($countAdmin>1) {
                    DB::table('users')->where('id', $user_id)->delete();
                }else{
                    alert()->warning('One admin should remain','Cannot Delete');
                    return back();
                }
            }
        }
                alert()->success('Account Successfully Deleted', 'Deleted');
                return back();
    }


    function admin_savePetVet(Request $request, $pet_id){
        $breed = $request->pet_breed_id;
        $gender = $request->pet_gender;
        $birthday = $request->pet_birthday;
        $notes = $request->pet_notes;
        $bloodtype = $request->pet_bloodType;
        $regDate = $request->pet_registeredDate;
        $type = $request->pet_type_id;
        $name = $request->pet_name;
        $customer = $request->customer_id;
        $clinic = $request->clinic_id;
        $status = $request->pet_isActive;

        $NoActionQuery = Pet::where('pet_name','=', $request->pet_name)
        ->where('pet_gender','=', $request->pet_gender)
        ->where('pet_birthday','=', $request->pet_birthday)
        ->where('pet_notes','=', $request->pet_notes)
        ->where('pet_bloodType','=', $request->pet_bloodType)
        ->where('pet_registeredDate','=',$request->pet_registeredDate)
        ->where('pet_type_id','=', $request->pet_type_id)
        ->where('pet_breed_id','=', $request->pet_breed_id)
        ->where('customer_id', '=', $request->customer_id)
        ->where('clinic_id','=', $request->clinic_id)
        ->where('pet_isActive','=', $request->pet_isActive)->first();

        if ($NoActionQuery) {
            alert()->message('Input something to change');
            return back();
        }else{
            Pet::where('pet_id', $pet_id)
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
                   'pet_isActive'=>$request->pet_isActive
               ]);

            $id = $request->customer_id;
            alert()->success('Pet has been updated sucessfully','Updated!');
            return redirect()->route('admin.adminPetView', ['customer_id'=>$request->customer_id]);
        }

    }


    function admin_getPetID($pet_id){
        $pluckID = Pet::where('pet_id', $pet_id)->pluck('customer_id')->first();
        $getCustID = Customer::where('customer_id','=', $pluckID)->first();
        $editPet = Pet::where('pet_id', '=', $pet_id)->first();
        $getTypePet = PetType::get();
        $getBreedPet = PetBreed::get();
        $getClinicPet = Clinic::get();
        $getOwnerPet = Customer::get();
        
        return view('admin.vet.adminEditPatient', compact('editPet', 'getTypePet', 'getBreedPet','getClinicPet','getOwnerPet', 'getCustID'));
    }


    function admin_DeletePet($pet_id){
        $delPet = Pet::where('pet_id',$pet_id)->delete();
        $getPetName = Pet::select('pet_name')->where('pet_id',$pet_id)->first();

        alert()->success('Pet info deleteted Successfully. Goodbye!', 'Successfully Deleted!');
        return back();
    }

    function pet_getPetID($pet_id){
        $pluckID = Pet::where('pet_id', $pet_id)->pluck('customer_id')->first();
        $getCustID = Customer::where('customer_id','=', $pluckID)->first();
        $editPet = Pet::select('pets.*','clinics.*')->where('pet_id', '=', $pet_id)->join('clinics','clinics.clinic_id','=','pets.clinic_id')->first();
        $getTypePet = PetType::get();
        $getBreedPet = PetBreed::get();
        $getClinicPet = Clinic::get();
        $getOwnerPet = Customer::get();
        
        return view('admin.pet.CRUDeditpet', compact('editPet', 'getTypePet', 'getBreedPet','getClinicPet','getOwnerPet', 'getCustID'));
    }


    function pet_savePetVet(Request $request, $pet_id){

        $breed = $request->pet_breed_id;
        $gender = $request->pet_gender;
        $birthday = $request->pet_birthday;
        $notes = $request->pet_notes;
        $bloodtype = $request->pet_bloodType;
        $regDate = $request->pet_registeredDate;
        $type = $request->pet_type_id;
        $name = $request->pet_name;
        $customer = $request->customer_id;
        $clinic = $request->clinic_id;
        $status = $request->pet_isActive;
        $getID = $request->getId;
        // dd($getID); die();


        $NoActionQuery = Pet::where('pet_name','=', $request->pet_name)
        ->where('pet_gender','=', $request->pet_gender)
        ->where('pet_birthday','=', $request->pet_birthday)
        ->where('pet_notes','=', $request->pet_notes)
        ->where('pet_bloodType','=', $request->pet_bloodType)
        ->where('pet_registeredDate','=',$request->pet_registeredDate)
        ->where('pet_type_id','=', $request->pet_type_id)
        ->where('pet_breed_id','=', $request->pet_breed_id)
        ->where('customer_id', '=', $request->customer_id)
        ->where('clinic_id','=', $request->clinic_id)
        ->where('pet_isActive','=', $request->pet_isActive)->first();

        $existingQuery = Pet::whereNotIn('pet_id',[$pet_id])->pluck('pet_bloodType')->first();
        $existingQuery2 = Pet::whereNotIn('pet_id',[$pet_id])->pluck('pet_type_id')->first();
        $existingQuery3 = Pet::whereNotIn('pet_id',[$pet_id])->pluck('pet_breed_id')->first();
        $existingQuery4 = Pet::whereNotIn('pet_id',[$pet_id])->pluck('customer_id')->first();
        $existingQuery5 = Pet::whereNotIn('pet_id',[$pet_id])->pluck('pet_name')->first();
        // dd($request->pet_birthday == $existingQuery); die();
        // $request->validate([
        //     'pet_name' => 'unique:pets,pet_name,'.$pet_id.',pet_id',
        //     // 'user_email' => "required | email | unique:users,email, $request->user_id",
        //     'pet_registeredDate' => ['after: 01-01-2005'],
        //     'pet_birthday' => ['after: 01-01-1998']
        // ],[
        //     'pet_name.unique' => 'Pet already exists',
        //     'pet_registeredDate.after' => 'Date must not be before 01-01-2005',
        //     'pet_birthday.after' => 'Date must not be before 01-01-2005'
        // ]);

        if ($NoActionQuery) {
            alert()->message('No changes / all are the same');
            return back();
        }else{
            if ($name == $existingQuery5 && $bloodtype == $existingQuery && $customer == $existingQuery4) {
                alert()->warning('Existing Pet');
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
                    'pet_isActive'=>$request->pet_isActive
                ]);

                alert()->success('Pet name updated successfully','Update Successful!');
                return redirect('/admin/CRUDpet');
            }
        }

    }
}

// $this->validate($request, array(
//     'clinic_blk' => "required | min:5 | max: 25 | unique:clinics,clinic_blk,$request->clinic_id",
// ));