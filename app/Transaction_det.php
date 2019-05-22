<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_det extends Model
{
    protected $table = "transaction_details";
	protected $primarykey ="id";
	protected $fillable = [
        'transactions_id','product_id','qty','discount','selling_price',
    ];
}
