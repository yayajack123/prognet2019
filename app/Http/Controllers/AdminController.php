<?php

namespace App\Http\Controllers;

use DB;
use App\Admin;
use App\Notifications\AdminNotification;
use App\Quotation;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $tahun = CARBON::NOW()->format('Y');
        $reportBulanan = Transaction::
        select(DB::raw('MONTHNAME(created_at) as bulan'), DB::raw('COALESCE(SUM(total),0) as pendapatan'))
            ->groupBy(DB::raw('MONTHNAME(created_at)'))
            ->where(DB::raw('YEAR(created_at)'),'=', $tahun)
            ->where('status','success')
            ->get();
        
        $reportTahunan = Transaction::
        select(DB::raw('YEAR(created_at) as tahun'), DB::raw('COALESCE(SUM(total),0) as pendapatan'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->where('status','success')
            ->get();
        return view('admin',compact("reportBulanan","reportTahunan"));
    }

    public function chart()
      {
        $tahun = CARBON::NOW()->format('Y');
        $result = \DB::table('transactions')
                    ->select(DB::raw('MONTHNAME(created_at) as bulan'), DB::raw('COALESCE(SUM(total),0) as pendapatan'))
                    ->groupBy(DB::raw('MONTHNAME(created_at)'))
                    ->where(DB::raw('YEAR(created_at)'),'=', $tahun)
                    ->where('status','success')
                    ->get();
        return response()->json($result);
      }
}