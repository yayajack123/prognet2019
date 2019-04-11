<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_name','price','description','product_rate','stock','weight'];
    protected $primarykey = 'id';
	public $timestamps = true;
}
