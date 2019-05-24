<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "product_reviews";
	protected $primarykey ="id";
	protected $fillable = [
        'product_id','user_id','rate','content'
    ];
}
