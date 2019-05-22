<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";
	protected $primarykey ="id";
	protected $fillable = [
        'address','regency','province','total','shipping_cost','sub_total','user_id','courier_id','proof_of_payment',
    ];
}
