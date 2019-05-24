<?php

namespace App\Http\Controllers;

use App\Notifications\UserNotif;
use App\Notifications\AdminNotif;
use App\User;
use Illuminate\Http\Request;
use App\Transaction;
use App\Transaction_det;
use App\Admin;
use Illuminate\Notifications\Notification;

class TransactionAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $transaction = Transaction::select('transactions.id','name','address','total','courier','timeout','transactions.status')->join('users','users.id','=','transactions.user_id')->join('couriers','transactions.courier_id','=','couriers.id')->get();
        return view('/admin/transaksi/approvement',compact("transaction"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function markReadAdmin(){
        $admin = Admin::find(2);
        
        $admin->unreadNotifications()->update(['read_at' => now()]);
        return response()->json($admin);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $total_price = 0;
        // return($transaction);
        $data = Transaction_det::join('transactions','transaction_details.transaction_id',
        '=','transactions.id')
        ->join('products','transaction_details.product_id','=','products.id')
        ->where('transaction_id',$id)
        ->get();
        foreach ($data as $key) {
            $total_price+=$key->selling_price*$key->qty;
        }
        // return $data;
        // return($data[0]["proof_of_payment"]);
        return view('/admin/transaksi/approvement_detail',compact("total_price","data"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $transaction = Transaction::where('id',$id)->get()->first();
        if ($transaction->status == 'unverified') {
            
            $transaction->status = 'verified';
            $transaction->save();
            $tuser= Transaction::where('id',$id)->first();
            $user = User::find($tuser->user_id);
            $user->notify(new UserNotif("Transaksi anda sudah Verified"));
        }
        else{

            $transaction->status = 'delivered';
            $transaction->save();

            $tuser= Transaction::where('id',$id)->first();
            $user = User::find($tuser->user_id);
            $user->notify(new UserNotif("Transaksi anda sudah Delivered"));

         }
         return redirect('/admin/transactionAdmin');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }

  
}

