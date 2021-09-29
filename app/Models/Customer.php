<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customers";

    protected $fillable = [
        'customer_fname',
        'customer_lname',
        'customer_mname',
        'customer_mobile',
        'customer_tel',
        'customer_gender',
        'customer_birthday',
        'customer_blk',
        'customer_street',
        'customer_subdivision',
        'customer_barangay',
        'customer_zip',
        'customer_city',
        'id',
        'customer_isActive',
    ];
}
