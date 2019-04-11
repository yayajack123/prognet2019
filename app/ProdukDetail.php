<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukDetail extends Model
{
    protected $table= "product_category_details";
    protected $primarykey = "id";
    protected $fillable = [
        'product_id','category_id',
    ];
}
