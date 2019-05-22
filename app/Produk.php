<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
	use SoftDeletes;
    protected $table = "products";
	protected $primarykey ="id";
	protected $fillable = [
        'product_name','price','description','product_rate','stock','weight',
    ];}
