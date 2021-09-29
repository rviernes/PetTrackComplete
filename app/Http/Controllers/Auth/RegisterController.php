<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\SweetAlertServiceProvider;
use Sweetalert\Sweetalert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required','alpha_dash', 'string', 'max:255','unique:users,username'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


    protected function create(array $data)
    {   


        $checkQuery = Customer::where('customer_fname', $data['customer_fname'])
                              ->where('customer_lname', $data['customer_lname'])
                              ->where('customer_mname', $data['customer_mname'])
                              ->first();
        if ($checkQuery) {
            alert()->warning('Customer already exists','Existing');
            return back();
        }else{
            $createAcc = User::create([
            'username' => $data['username'],
            'phone' => $data['phone'],
            'usertype' => $data['usertype'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

            $createAcc->userData = Customer::create([
                'customer_fname' => ucwords($data['customer_fname']),
                'customer_lname' => ucwords($data['customer_lname']),
                'customer_mname' => ucwords($data['customer_mname']),
                'customer_mobile' => $data['customer_mobile'],
                'customer_tel' => $data['customer_tel'],
                'customer_gender' => $data['customer_gender'],
                'customer_birthday' => $data['customer_birthday'],
                'customer_blk' => ucwords($data['customer_blk']),
                'customer_street' => ucwords($data['customer_street']),
                'customer_subdivision' => ucwords($data['customer_subdivision']),
                'customer_barangay' => ucwords($data['customer_barangay']),
                'customer_zip' => $data['customer_zip'],
                'customer_city' => ucwords($data['customer_city']),
                'id' => $createAcc->id,
                'customer_isActive' => 1,
            ]);

        return $createAcc;
        }
    }
}
