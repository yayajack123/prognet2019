<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = "response";
	protected $primarykey ="id";
	protected $fillable = [
        'review_id','admin_id','content'
    ];
}
