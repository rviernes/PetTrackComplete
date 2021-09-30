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

class UserController extends Controller
{
    function showDashboard(){
        return view('customer.dashboard');
    }

    final function logout(){
        Auth::logout();
        return redirect('/login');
    }


    final function editProfile(){
        $LoggedUserInfo = User::join('veterinaries','veterinaries.id','=', 'users.id')
        ->select('*')
        ->where('users.id','=', auth()->user()->id)->first();

        dd($LoggedUserInfo); die();

        return view('customer.custProfile', compact('LoggedUserInfo'));

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
}

