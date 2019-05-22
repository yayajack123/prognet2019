@extends('layout.layout1')
@section('title','Your Cart')
@section('page',' Cart')
@section('content')
    <style type="text/css">
        legend{
            color: black;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            <form action="/transaction/{{$data[0]->transaction_id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <legend>Proof of Payment</legend>    

                @if(empty($data[0]->status))
                    <div class="form-group">
                        <input type="file" name="proof_of_payment" id="proof_of_payment" class="form-control">>
                    </div>

                    <div style="text-align: left;">
                        <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                    </div>
                @elseif($data[0]->status == 'unverified')
                    <p style="color: black;">Your Payment Proof is still Processing</p>
                @else
                    <p style="color: black;">Your Payment has Success</p>
                @endif
            </form>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="container">
    <div class="row">
            <div class="col-sm-4">
                <legend>Detail Transaction</legend>
            </div>
        </div>
    </div> 
    <section id="cart_items">

        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-success text-center" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td>No</td>
                        <td class="image">Item</td>
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="discount">Discount</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody style="color: black;">

                        @foreach($data as $data)
                        <?php
                                $image_products=DB::table('products')->select('image_name')->join('product_images','product_images.product_id','=','products.id')->where('products.id',$data->product_id)->get()->first();
                                $image_data = DB::table('products')->where('products.id',$data->product_id)->get()->first();
                        ?>
                        
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="cart_product">
                                    {{-- @foreach($image_products as $image_product) --}}
                                        <a href=""><img src="{{url('images/small',$image_products->image_name)}}" alt="" style="width: 100px;"></a>
                                    {{-- @endforeach --}}
                                </td>
                                <td class="cart_description">
                                    <p style="font-size: 15px">{{$image_data->product_name}}</p>
                                </td>
                                <td class="cart_price">
                                    <p style="font-size: 15px">Rp {{number_format($image_data->price)}}</p>
                                </td>

                                <td class="cart_quantity">
                                    {{$data->qty}}
                                </td>
                                <td>
                                    {{$data->discount}}%
                                </td>

                                <td class="cart_total">
                                    <p style="font-size: 15px">Rp {{number_format($data->qty*$data->selling_price)}}</p>
                                </td>
                                
                            </tr>

                            
                             
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        

    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            {{-- <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div> --}}
            <div class="row">
                <div class="col-sm-6">
                {{--     @if(Session::has('message_coupon'))
                        <div class="alert alert-danger text-center" role="alert">
                            {{Session::get('message_coupon')}}
                        </div>
                    @endif
                    <div class="chose_area" style="padding: 20px;">
                        <form action="{{url('/apply-coupon')}}" method="post" role="form">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="Total_amountPrice" value="{{$total_price}}">
                            <div class="form-group">
                                <label for="coupon_code">Coupon Code</label>
                                <div class="controls {{$errors->has('coupon_code')?'has-error':''}}">
                                    <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Promotion By Coupon">
                                    <span class="text-danger">{{$errors->first('coupon_code')}}</span>
                                </div>
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </form>
                    </div> --}}
                </div>
                <div class="col-sm-6">
                    @if(Session::has('message_apply_sucess'))
                        <div class="alert alert-success text-center" role="alert">
                            {{Session::get('message_apply_sucess')}}
                        </div>
                    @endif
                    <div class="total_area" >
                        <ul>
                                <li style="background: white; color: black;">Shipping Cost <span>Rp {{number_format($data->shipping_cost)}}</span></li>         
                                <li style="background: white; color: black;">Sub Total <span>Rp {{number_format($total_price)}}</span></li>
                                <li >Total <span>Rp {{number_format($data->shipping_cost+$total_price)}}</span></li>
                        </ul>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->

    
@endsection