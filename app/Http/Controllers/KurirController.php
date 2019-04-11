<?php

namespace App\Http\Controllers;

use App\Kurir;
use Illuminate\Http\Request;

class KurirController extends Controller
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
        $data = Kurir::all();
        return view('admin.kurir.kurir',compact('data'));
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
        $kurir = new Kurir;
        $kurir->courier = $request->nama_kurir;
        $kurir->save();
        
        return redirect('/admin/kurir');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function show(Kurir $kurir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function edit(Kurir $kurir)
    {
        $data1 = Kurir::find($kurir)->first();
        return view('admin.kurir.editkurir',compact('data1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kurir $kurir)
    {
        $kurir->courier = $request->nama_kurir;
        $kurir->save();
        return redirect('/admin/kurir');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kurir $kurir)
    {
        $kurir->delete();     //ERROR HERE
        return redirect('/admin/kurir')->with('alert-success','Data berhasil dihapus!');
    }
}
