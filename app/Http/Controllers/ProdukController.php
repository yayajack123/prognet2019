<?php

namespace App\Http\Controllers;

use DB;
use App\GambarProduk;
use App\Kategori;
use App\ProdukDetail;
use App\Quotation;
use App\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
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
        
        
        return view("admin.produk.index",compact('index'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::get();
        return view("/admin/produk/create",compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Produk;
        $product->product_name= $request->nama_produk;
        $product->price= $request->harga;
        $product->description= $request->deskripsi;
        $product->product_rate= $request->rating;
        $product->stock= $request->stok;
        $product->weight= $request->berat;
        $product->save();
        
        if(is_array($request->kategori)){
            foreach($request->kategori as $kat){
                $cat = new ProdukDetail;
                $cat->product_id = $product->id;
                $cat->category_id = $kat;
                $cat->save();
            }
        }
        
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);      

        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/', $name);  
                $form= new GambarProduk();   
                $form->product_id = $product->id;
                $form->image_name=$name;  
                $form->save();       
            }
        }
        return redirect('/admin/produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        $test = Produk::find($produk)->first();
        return view("/admin/produk/edit",compact("test"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $produk->product_name= $request->nama_produk;
        $produk->price= $request->harga;
        $produk->description= $request->deskripsi;
        $produk->product_rate= $request->rating;
        $produk->stock= $request->stok;
        $produk->weight= $request->berat;
        $produk->save();
        return redirect('/admin/produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
