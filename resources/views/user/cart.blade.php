@extends('layout.layout1')
@section('title','Your Cart')
@section('page',' Cart')
@section('content')

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Cart Page</h2>
         <ol class="breadcrumb">
           <li><a href="index.html">Home</a></li>                   
           <li class="active">Cart</li>
         </ol>
       </div>
      </div>
    </div>
   </section> 
   <!-- / catg header banner section -->
 
  <!-- Cart view section -->
  <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th></th>
                         <th></th>
                         <th>Product</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total</th>
                       </tr>
                     </thead>
                     <tbody>
                            @foreach($cart_datas as $cart_data)
                            <?php
                                    $image_products=DB::table('products')->select('image_name')->join('product_images','product_images.product_id','=','products.id')->where('products.id',$cart_data->product_id)->get();
                                    $image_data = DB::table('products')->where('products.id',$cart_data->product_id)->get()->first();
                            ?>
                            <input type="hidden" name="stock" id="stock-{{$cart_data->product_id}}" value="{{$cart_data->stock}}">
                       <tr id="tr-{{$cart_data->product_id}}">
                          <script type="text/javascript">
                            $(document).ready(function(){
                                $('#klik-{{$cart_data->product_id}}').click(function(){
                                    var qty_awal = $('.cart_quantity_input-{{$cart_data->product_id}}').val();
                                    var stock = parseInt($('#stock-{{$cart_data->product_id}}').val());
                                    var qty_akhir = parseInt(qty_awal) + 1;
                                    if (qty_akhir > stock) {
                                        alert("stok tidak mencukupi!");
                                    }
                                    else{
                                        $('.cart_quantity_input-{{$cart_data->product_id}}').val(qty_akhir);    
                                    }
                                    event.preventDefault();
                                });

                                $('#klik1-{{$cart_data->product_id}}').click(function(){
                                    var qty_awal = $('.cart_quantity_input-{{$cart_data->product_id}}').val();
                                    var qty_akhir = parseInt(qty_awal) - 1;
                                    if (qty_akhir == 0) {
                                        var qty_akhir = 1;
                                    }
                                    $('.cart_quantity_input-{{$cart_data->product_id}}').val(qty_akhir);
                                    event.preventDefault();
                                });

                                $('#hapus-{{$cart_data->product_id}}').click(function(){
                                    console.log("terklik");
                                    $('#tr-{{$cart_data->product_id}}').remove();
                                });

                            });
                        </script>
                         <td><a class="cart_quantity_delete" href="javascript:" rel="{{$cart_data->id}}"  id="hapus-{{$cart_data->id}}"><fa class="fa fa-close"></fa></a></td>
                         @foreach ($image_products as $images_product)
                         <td><a href="#"><img src="{{url('images/',$images_product->image_name)}}" alt="img"></a></td>
                         @endforeach
                       <td><a class="aa-cart-title" href="#">{{$image_data->product_name}}</a></td>
                       <td>${{$image_data->price}}</td>
                         <td>
                           <input class="form-control" style="width:20%;" type="number" value="{{$cart_data->qty}}"></td>
                         <td>{{$image_data->price*$cart_data->qty}}</td>
                       </tr>
                       @endforeach
                       </tbody>
                   </table>
                 </div>
        
              <!-- Cart Total view -->
              <div class="cart-view-total">
                <h4>Cart Totals</h4>
                <table class="aa-totals-table">
                  <tbody>
                    <tr>
                      <th>Total</th>
                      <td>{{$total_price}}</td>
                    </tr>
                  </tbody>
                  
                </table>
                <a href="{{url('/check-out')}}" class="aa-cart-view-btn">Proced to Checkout</a>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
      $(".cart_quantity_delete").click(function () {
          var id=$(this).attr('rel');
          var deleteFunction=$(this).attr('rel1');
          swal({
              title:'Are you sure?',
              text:"You won't be able to revert this!",
              type:'warning',
              showCancelButton:true,
              confirmButtonColor:'#3085d6',
              cancelButtonColor:'#d33',
              confirmButtonText:'Yes, delete it!',
              cancelButtonText:'No, cancel!',
              confirmButtonClass:'btn btn-success',
              cancelButtonClass:'btn btn-danger',
              buttonsStyling:false,
              reverseButtons:true
          },function () {
              window.location.href="/cart/deleteItem/"+id;
          });
      });
  
  </script> 
@endsection