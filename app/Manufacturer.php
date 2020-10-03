<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = 'manufacturers';
    public $timestamps =false;
    protected $primaryKey = 'manufacturer_id';
}
