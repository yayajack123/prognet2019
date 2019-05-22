<?php

namespace App\Http\Controllers;


use App\User;
use App\Discount;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use App\Cart;
use App\Kurir;
use Agungjk\Rajaongkir\RajaOngkirFacade as RajaOngkir;




class CheckOutController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth:web');
    }


    public function index(){

      


    	$client = new \GuzzleHttp\Client();
    	try{
    		$response = $client->get('https://api.rajaongkir.com/starter/city',
    			array(
    				'headers' => array(
    					'key' => '248b6738fe208a6df6b1af7ea7f9bebc'
    				)
    			)
    		);
    	}catch(RequestException $e){
    		var_dump($e->getResponse()->getBody()->getContent());
    	}

      $session_id=Session::get('session_id');
    	$json = $response->getBody()->getContents();
    	$array_result = json_decode($json,true);
      $hai = $array_result["rajaongkir"]["results"];  
      $jum = count($hai);
      $countries=$hai;
      $user_login=User::where('id',Auth::id())->first();
      $courier=Kurir::get();

      // return($countries);

      $cart_datas=Cart::select('carts.id','user_id','product_id','stock','qty','status','price','percentage')
            ->join('products','carts.product_id','=','products.id')
            ->leftjoin('discounts','products.id','=','discounts.id_product')
            ->where('user_id',Auth::id())
            ->where('status','notyet')
            // ->groupBy('carts.id')
            ->get();
      $total_price=0;
        // return($cart_datas);
      foreach ($cart_datas as $cart_data){
          $diskon = Discount::where('id_product',$cart_data->product_id)->where('start','<=',CARBON::NOW())->where('end','>=',CARBON::NOW())->get()->first();
          if (!empty($diskon)) {
              $cart_data->price = ((100-$diskon->percentage)*$cart_data->price/100);      
          }
          $total_price+=$cart_data->price*$cart_data->qty;
        }

      return view('checkout.index',compact('countries','user_login','courier','total_price'));
    }

    public function checkshipping(Request $request){
        $client = new \GuzzleHttp\Client();
        try{
          $response = $client->get('https://api.rajaongkir.com/starter/city',
            array(
              'headers' => array(
                'key' => '248b6738fe208a6df6b1af7ea7f9bebc'
              )
            )
          );
        }catch(RequestException $e){
          var_dump($e->getResponse()->getBody()->getContent());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);
        $hai = $array_result["rajaongkir"]["results"];  
        $jum = count($hai);
        $countries=$hai;
        $postal= $request->kota;
        for ($i=0; $i < $jum ; $i++) { 
          if ($countries[$i]["postal_code"] == $postal) {
            $kota = $countries[$i]["city_name"];
            $province_id = $countries[$i]["province_id"];
          }
        }
        
        $client = new \GuzzleHttp\Client();
        try{
          $response = $client->get('https://api.rajaongkir.com/starter/province',
            array(
              'headers' => array(
                'key' => '248b6738fe208a6df6b1af7ea7f9bebc'
              )
            )
          );
        }catch(RequestException $e){
          var_dump($e->getResponse()->getBody()->getContent());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);
        $list_province = $array_result["rajaongkir"]["results"];
        $count_province = count($list_province);
        for ($i=0; $i <$count_province ; $i++) { 
          if ($list_province[$i]["province_id"]==$province_id) {
              $provinsi = $list_province[$i]["province"];
            }  
        }
        

        $cart_datas=Cart::select('carts.id','user_id','product_id','stock','qty','status','price','percentage')
            ->join('products','carts.product_id','=','products.id')
            ->leftjoin('discounts','products.id','=','discounts.id_product')
            ->where('user_id',Auth::id())
            ->where('status','notyet')
            ->get();
      $total_price=0;
        // return($cart_datas);
      foreach ($cart_datas as $cart_data){
          $diskon = Discount::where('id_product',$cart_data->product_id)->where('start','<=',CARBON::NOW())->where('end','>=',CARBON::NOW())->get()->first();
          if (!empty($diskon)) {
              $cart_data->price = ((100-$diskon->percentage)*$cart_data->price/100);      
          }
          $total_price+=$cart_data->price*$cart_data->qty;
        }
        // return($total_price);

        $client = new \GuzzleHttp\Client();
        try{
          $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
            [
              'body' => "origin=80227&destination=".$request->kota."&weight=1000&courier=".$request->kurir,
              // 'body' => "origin=Denpasar&destination=Cirebon".$request->tujuan."&weight=1000&courier=".$request->courier,
              'headers' => [
                
                'key' => '248b6738fe208a6df6b1af7ea7f9bebc',
                'content-type' => 'application/x-www-form-urlencoded',
              ]
            ]
          );
        }catch(RequestException $e){
          var_dump($e->getResponse()->getBody()->getContent());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);
        $service = ($array_result["rajaongkir"]["results"]["0"]["costs"]);

        $user_login=User::where('id',Auth::id())->first();
        $courier=Kurir::get();
        $nama = $request->nama;
        $kurir=$request->kurir;
        $alamat = $request->alamat;
        $telpon = $request->telpon;
        // return($service);
        return view("checkout.index",compact("service",'countries','user_login','courier','kurir','total_price','kota','provinsi','alamat','nama','telpon'));

    }
    
    public function submitcheckout(Request $request){
      $data=$request->all();
      
      return redirect('/order-review',compact($data));

    }
}
