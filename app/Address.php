<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = [
        'province_code', 'city_municipality_code', 'baranggay_code','customer_id','phone_number'
    ];
}
