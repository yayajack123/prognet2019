<?php

namespace App\Http\Controllers;

use App\ProdukCustomer;
use DB;
use App\GambarProduk;
use App\Kategori;
use App\ProdukDetail;
use App\Quotation;
use App\Produk;
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
    public function show(ProdukCustomer $produkCustomer)
    {
        //
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
