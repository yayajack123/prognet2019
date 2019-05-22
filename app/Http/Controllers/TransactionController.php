<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Transaction_det;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::select('transactions.id','address','total','courier','timeout','status')->join('couriers','transactions.courier_id','=','couriers.id')->where('user_id',Auth::id())->orderBy('transactions.created_at','desc')->get();
        
        return view('user.transaction_list',compact("transaction"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $total_price = 0;
        // return($transaction);
        $data = Transaction_det::all();
        foreach ($data as $key) {
            $total_price+=$key->selling_price*$key->qty;
        }
        return view('/user/transaction_detail',compact("data","total_price"));
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        if($request->hasfile('proof_of_payment'))
        {
                $image=$request->file('proof_of_payment');
                $name=$image->getClientOriginalName();
                $large_image_path=public_path('images/large/'.$name);
                $medium_image_path=public_path('images/medium/'.$name);
                $small_image_path=public_path('images/small/'.$name);
                        //// Resize Images
                Image::make($image)->save($large_image_path);
                Image::make($image)->resize(600,600)->save($medium_image_path);
                Image::make($image)->resize(300,300)->save($small_image_path);
                // $image->move(public_path().'/images/', $name);  
                $transaction->proof_of_payment=$name;  
               
            
        }
        $transaction->status='unverified';
        $transaction->save();

        return redirect('/transaction');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
