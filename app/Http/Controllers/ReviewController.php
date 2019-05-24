<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Review;
use App\Produk;
use DB;
use App\Quotation;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
             
        $jumlah = count($request->product_id);
        
        for ($i=0; $i< $jumlah ; $i++) {
            $review = new Review; 
            $review->product_id = $request->product_id[$i];
            $review->user_id = Auth::id();
            $review->rate = $request->rating[$i];
            $review->content = $request->review[$i];
            $review->save();

            $jum=Review::where('product_id',$request->product_id[$i])->count();
            $sum=Review::select(DB::raw('SUM(rate) as sum'))->where('product_id',$request->product_id[$i])->first();
            
            $hasil=$sum->sum/$jum;
            
            $product = Produk::where('id',$request->product_id[$i])->get()->first();
            $product->product_rate = (int)$hasil;
            
            $product->save();

        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
