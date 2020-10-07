<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'product_id';
    protected $table = 'products';

    public function images()
    {
        return $this->hasMany('App\Images');
    }
    public function manufacturers()
    {
        return $this->belongsTo('App\Manufacturer');
    }
}
