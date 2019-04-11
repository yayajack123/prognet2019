<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    protected $table = "product_images";
    protected $id= "id";
    protected $fillable = [
        'product_id','image_name',
    ];
}
