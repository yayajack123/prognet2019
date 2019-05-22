<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function index(){
        
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
                $cart_data->percentage = $diskon->percentage;
            }
            else{
                $cart_data->percentage = "-";
            }
            $total_price+=$cart_data->price*$cart_data->qty;
        }
        
        // return($cart_datas);
        return view('user.cart',compact('cart_datas','total_price'));
    }

    public function addToCart(Request $request){
        
        $inputToCart=$request->all();
        Session::forget('discount_amount_price');
        Session::forget('coupon_code');
        // if($inputToCart['size']==""){
        //     return back()->with('message','Please select Size');
        // }else{
            $stockAvailable=$inputToCart['stock'];
            if($stockAvailable>=$inputToCart['quantity']){
                $inputToCart['user_id']=Auth::id();
                $count_duplicateItems=Cart::where('product_id',$inputToCart['product_id'])->where('user_id',$inputToCart['user_id'])->where('status','notyet')->count();
                if($count_duplicateItems>0){
                    return back()->with('message','This Item Added already');
                }else{
                    
                    $cart = new Cart;
                    $cart->user_id = $inputToCart["user_id"];
                    $cart->product_id = $request->product_id;
                    $cart->qty = $request->quantity;
                    $cart->status = 'notyet';
                    $cart->save();
                    // return($cart);
                    return back()->with('success','Add To Cart Already');
                }
            }else{
                return back()->with('message','Stock is not Available!');
            }
        // }
    }


    public function deleteItem($id=null){
        $delete_item=Cart::findOrFail($id);
        $delete_item->delete();
        return back()->with('message','Deleted Success!');
    }


    public function update(request $request, Cart $cart){
        
        // $sku_size=DB::table('cart')->select('product_code','size','quantity')->where('id',$id)->first();
        
        $cart = Cart::where('id',$request->id)->get->first();
        $cart->qty = $request->qty;
      // update cart
        $cart->save();

        $output = '<div class="alert alert-success"> Data Updated </div>';

        echo json_encode($output);
        return redirect()->back();

    //     $cart_data = Cart::where('id',$id)->get()->first();
    //     // return($cart_data->qty);
    //     $stockAvailable=Product::where('id',$cart_data->product_id)->get()->first();
    //     $updated_quantity=$cart_data->qty+$quantity;

    //     if($stockAvailable->stock >= $updated_quantity){
    //         DB::table('carts')->where('id',$id)->increment('qty',$quantity);
    //         return back()->with('message','Update Quantity already');
    //     }else{
    //         return back()->with('message','Stock is not Available!');
    //     }
    }


}
