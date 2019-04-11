<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'product_categories';
    protected $fillable = ['category_name'];
    protected $primarykey = 'id';
	public $timestamps = true;
}
