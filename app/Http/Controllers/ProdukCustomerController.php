<?php

namespace App\Http\Controllers;

use Session;
use App\ProdukCustomer;
use DB;
use App\GambarProduk;
use App\Kategori;
use App\ProdukDetail;
use App\Quotation;
use App\Produk;
use App\Cart;
use App\Review;
use Illuminate\Http\Request;

class ProdukCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Produk::select('products.id','products.product_name','products.price','description','product_rate','stock','weight','product_images.image_name','product_categories.category_name')
        ->join('product_category_details','products.id','=','product_category_details.product_id')
        ->join('product_images','products.id','=','product_images.product_id')
        ->join('product_categories','product_category_details.category_id','=','product_categories.id')
        ->get();
        
        
        return view("user.welcome",compact('index'));
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
     * @param  \App\ProdukCustomer  $produkCustomer
     * @return \Illuminate\Http\Response
     */
    public function show($produkCustomer)
    {
        // $gas = Produk::select('products.id','products.product_name','products.price','description','product_rate','stock','weight','product_images.image_name','product_categories.category_name')
        // ->join('product_category_details','products.id','=','product_category_details.product_id')
        // ->join('product_images','products.id','=','product_images.product_id')
        // ->join('product_categories','product_category_details.category_id','=','product_categories.id')
        // ->where('products.id','=',$produkCustomer)
        // ->findOrFail($id);
        $detail_product=Produk::findOrFail($produkCustomer);
        $images=GambarProduk::where('product_id',$produkCustomer)->get();
        $kat = ProdukDetail::select('product_categories.category_name')
             ->join('product_categories','product_category_details.category_id','=','product_categories.id')        
             ->where('product_category_details.product_id',$produkCustomer)
             ->get();
        $session_id=Session::get('session_id');
        $cart_datas=Cart::select('carts.id','user_id','product_id','stock','qty','status','session_id','price')
                 ->join('products','carts.product_id','=','products.id')
                 ->where('session_id',$session_id)->get();
        $total_price=0;
             foreach ($cart_datas as $cart_data){
                 $total_price+=$cart_data->price*$cart_data->qty;
             }
        $review = Review::join('users','product_reviews.user_id','=','users.id')->where('product_id',$produkCustomer)->orderBy('product_reviews.created_at','desc')->get();

        return view('user.produkdetail',compact('detail_product','images','kat','cart_datas','total_price','review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProdukCustomer  $produkCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdukCustomer $produkCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProdukCustomer  $produkCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdukCustomer $produkCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProdukCustomer  $produkCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdukCustomer $produkCustomer)
    {
        //
    }
}
