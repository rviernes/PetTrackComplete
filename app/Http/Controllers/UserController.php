<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vets;
use App\Models\Admin;
use App\Models\Customers;
use App\Models\Clinic;
use App\Models\PetBreeds;
use App\Models\Pets;
use App\Models\PetTypes;
use App\Models\UserTypes;
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

class UserController extends Controller
{
    function showDashboard(){
        return view('customer.dashboard');
    }

    final function logout(){
        Auth::logout();
        return redirect('/login');
    }
}