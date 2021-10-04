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
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    function showDashboard(){
        $petinfo = Pet::get();

        $LoggedUserInfo = DB::table('users')
        ->join('customers','customers.id','=', 'users.id')
        ->select('users.*','customers.*')
        ->where('users.id','=', auth()->user()->id)->first();

        return view('customer.dashboard', compact('petinfo','LoggedUserInfo'));
    }

    final function logout(){
        Auth::logout();
        return redirect('/');
    }


    final function editProfile(){
        $LoggedUserInfo = User::join('customers','customers.id','=', 'users.id')
        ->select('customers.*','users.*')
        ->where('users.id','=', auth()->user()->id)->first();

        // dd($LoggedUserInfo); die();

        return view('customer.custAcc', compact('LoggedUserInfo'));

        // return dd($data);
    }

    final function userProfile(){
        $LoggedUserInfo = DB::table('users')
        ->join('customers','customers.id','=', 'users.id')
        ->select('users.*','customers.*')
        ->where('users.id','=', auth()->user()->id)->first();

        // dd(auth()->user()->id); die();  
        return view('customer.custProfile', compact('LoggedUserInfo'));

        // return dd($data);
    }

    public function widgetPets(){
        $LoggedUserInfo = User::join('customers','customers.id','=', 'users.id')
                              ->select('customers.*','users.*')
                              ->where('users.id','=', auth()->user()->id)->first();

        $customerid = Customer::select('customer_id')
                              ->where('user_id','=', auth()->user()->id)->pluck('customer_id')->first();

        $petinfo = Pet::where('customer_id','=', $customerid) -> get();
        
        return view('customer.custhome', compact('LoggedUserInfo','petinfo'));
    
          
        // return dd($widgetPets);
    }

    function changePw(Request $request){
        $request->validate([
            'oldpass' => ['required', new MatchOldPassword],
            'new_pass' => 'required',
            'check_pass' => 'required | same:new_pass'
        ]);
            $verifyUser = User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_pass)]);
                alert()->success('Password successfully changed','Password Updated');
                return back();
    }

    public function custProfile(Request $request, $customer_id, $user_id){

        $NoActionQueryUser = User::where('username', '=', $request->user_name)
                                 ->where('phone', '=', $request->user_mobile) // query for not changes user_account
                                 ->where('email', '=', $request->user_email)->first();

        $NoActionQueryCustomer = Customer::where('customer_fname','=', $request->customer_fname)
                                         ->where('customer_lname','=', $request->customer_lname)
                                         ->where('customer_mname','=', $request->customer_mname)
                                         ->where('customer_mobile','=', $request->customer_mobile)
                                         ->where('customer_tel','=', $request->customer_tel)
                                         ->where('customer_blk','=',$request->customer_blk)    // query for not changes customer
                                         ->where('customer_street','=', $request->customer_street)
                                         ->where('customer_subdivision','=', $request->customer_subdivision)
                                         ->where('customer_barangay', '=', $request->customer_barangay)
                                         ->where('customer_city', '=', $request->customer_city)
                                         ->where('customer_zip','=', $request->customer_zip)->first();

        $request->validate([
            'user_name' => "required | min:5 | max: 20 | unique:users,username,$request->user_id",
            'user_email' => "required | email | unique:users,email, $request->user_id",
        ]);
        if ($NoActionQueryUser && $NoActionQueryCustomer) {
            alert()->message('Input something to change');
            return back();
        }
            User::where('id',$user_id)
            ->update([
                'username'=>$request->user_name,
                'phone'=>$request->user_mobile,
                'email'=>$request->user_email
            ]);
       
            Customer::where('customer_id', $customer_id)
            ->update([
                'customer_fname'=>$request->customer_fname,
                'customer_lname'=>$request->customer_lname,
                'customer_mname'=>$request->customer_mname,
                'customer_mobile'=>$request->customer_mobile,
                'customer_tel'=>$request->customer_tel,
                'customer_blk'=>$request->customer_blk,
                'customer_street'=>$request->customer_street,
                'customer_subdivision'=>$request->customer_subdivision,
                'customer_barangay'=>$request->customer_barangay,
                'customer_city'=>$request->customer_city,
                'customer_zip'=>$request->customer_zip
            ]);
            
            alert()->success('Profile updated successfully', 'Updated');
            return back();
        
    }

    final function usersPets(){
        $petinfo = Pet::join('pet_types','pet_types.id','pets.pet_type_id')
                      ->join('pet_breeds','pet_breeds.breed_id','pets.pet_breed_id')
                      ->join('clinics','clinics.clinic_id','pets.clinic_id')
                      ->join('customers','customers.customer_id','pets.customer_id')
                      ->join('users','users.id','customers.id')
                      ->where('users.id','=',auth()->user()->id)
                      ->get();

        $LoggedUserInfo = DB::table('users')
        ->join('customers','customers.id','=', 'users.id')
        ->select('users.*','customers.*')
        ->where('users.id','=', auth()->user()->id)->first();

        return view('customer.viewPatient', compact('petinfo','LoggedUserInfo'));
    }
    
}

