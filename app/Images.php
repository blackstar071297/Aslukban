<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'product_image_id';
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
