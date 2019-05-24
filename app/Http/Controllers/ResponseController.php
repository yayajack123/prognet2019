<?php

namespace App\Http\Controllers;

use App\Response;
use App\Review;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Review::select('product_reviews.id','product_id','user_id','rate','content','status')->join('products','product_reviews.product_id','=','products.id')->orderBy('product_reviews.created_at','desc')
            ->get();
        
        return view('admin/respon/response',compact("response"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createResponse($request)
    {
        $review = Review::where('id',$request)->get()->first();
        
        return view('/admin/respon/create_response',compact('review'));
    }


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
        $response = new Response;
        $response->review_id = $request->review_id;
        $response->admin_id = Auth::guard('admin')->user()->id;
        $response->content = $request->response;
        $response->save();

        $review = Review::where('id',$request->review_id)->first();
        $review->status = "replied";
        $review->save();


        $response = Review::select('product_reviews.id','product_id','user_id','rate','content','status')->join('products','product_reviews.product_id','=','products.id')->orderBy('product_reviews.created_at','desc')
            ->get();

        return view('admin/respon/response',compact("response"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
