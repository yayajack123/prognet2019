@extends('layout.layout1')
@section('title','Your Cart')
@section('page',' Cart')
@section('content')
<style type="text/css">
    legend,label,p{
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
            <input type="hidden" name="id" id="id" value="{{$data[0]->transaction_id}}">
            @if(empty($data[0]->status))
                <div class="form-group">
                    <input type="file" name="proof_of_payment" id="proof_of_payment" class="form-control">>
                </div>

                <div style="text-align: left;">
                    <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                </div>
            @elseif($data[0]->status == 'unverified')
            <div class="form-group">
                    <input type="file" name="proof_of_payment" id="proof_of_payment" class="form-control">>
                </div>

                <div style="text-align: left;">
                    <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                </div>
            @elseif($data[0]->status == 'delivered')
                {{-- </form> --}}

                <div style="text-align: left;">
                    <button type="submit" name="submit" {{-- onclick="myFunction()" --}} id="success" class="btn btn-danger">Set Status Success</button>
                </div>
            @elseif($data[0]->status == 'success')
                </form>
                <p style="color: black;">Your Payment has Success</p>
                 <div style="text-align: left;">
                    <button type="submit" name="submit" onclick="myFunction()" id="ulasan" class="btn btn-danger">Review Item</button>
                </div>
            @else
                <p style="color: black;">Your Payment has Success</p>
            @endif
        </form>
        </div>
    </div>
</div>

<div class="container" id="review" style="display: none;">
<hr>
<br><br>
    <div class="row">
        <div class="col-sm-4">
        <form action="/review" method="post" enctype="multipart/form-data">
            @csrf
            
            <legend>Review Item</legend>    

            @foreach($data as $d)
            <?php
                $image_products=DB::table('products')->select('image_name')->join('product_images','product_images.product_id','=','products.id')->where('products.id',$d->product_id)->get()->first();
            ?>
                <input type="hidden" name="product_id[]" value="{{$d->product_id}}">
                <table>
                <td><a href=""><img src="{{url('images/small',$image_products->image_name)}}" alt="" style="width: 100px;"></a></td>
                <td>    </td>
                <td><p style="font-size: 30px; float: right;">{{$d->product_name}}</p></td>
                </table>
                <br>
                <div class="form-group">
                    <label>Rating (1-5)</label>
                    <input autofocus="" type="text" name="rating[]"  class="form-control">>
                </div>
                <div class="form-group">
                    <label>Review</label>
                    <input type="text" name="review[]" class="form-control">>
                </div>
                
                <hr>
            @endforeach
                <input type="submit" value="submit review" class="btn btn-danger">
        </form>
        </div>
    </div>
    <hr>
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
                                    <a href=""><img src="{{url('images',$image_products->image_name)}}" alt="" style="width: 100px;"></a>
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
<script type="text/javascript">
    //  $(document).ready(function(){
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $('#success').click(function(){
    //         console.log("terklik");
    //         var baseUrl = window.location.protocol+"//"+window.location.host;
    //         var status = "success"
    //         var id = parseInt($('#id').val());
    //         console.log(id);
            
    //         $.ajax({
    //               url: baseUrl+'/transactionStatus/'+id,  
    //               type : 'post',
    //               dataType: 'JSON',
    //               data: {
    //                 "_token": "{{ csrf_token() }}",
    //                 id: id,
                    
    //                 },
    //               success:function(response){
                        
    //                     event.preventDefault();
    //               },
    //               error:function(){
    //                 alert("fail");
    //               }

    //           });
    //     });
    // });

    function myFunction() {
    
    var x = document.getElementById("review");
    
      if (x.style.display === "none") {
        x.style.display = "block";

      } 
      else {
        x.style.display = "none";
      }
    }
</script>

@endsection