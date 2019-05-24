@extends('layouts.app')
@section('content')
    
    <div class="container-fluid">
        <div class="row-fluid">
            {{-- <div class="span3"></div> --}}
            
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                    <h5>Proof of Payment</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="/admin/transactionAdmin/{{$data[0]->transaction_id}}">
                    @csrf
                    @method('PUT')
                        <div class="control-group{{$errors->has('courier')?' has-error':''}}">
                            
                            
                              <center><a href="#"><img src="{{url('images/small',$data[0]["proof_of_payment"])}}" alt="" onclick="window.open(this.src)" border="3"></a></center>
                            
                        </div>
                         <div class="control-group">
                            @if($data[0]->status == 'unverified')
                                <center><input type="submit" name="submit" value="Verify Payment" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"></center>
                            @elseif($data[0]->status == 'verified')
                                <center><input type="submit" name="submit" value="Deliver" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"></center>
                            @else
                                <center><b>Verified</b></center>
                            @endif
                        </div>
                        <br>
                    </form>
                </div>
            </div>
            {{-- <div class="span3"></div> --}}
        </div>
            
        </div>
        </div>
    
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done!</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Approvement Detail</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>item</th>
                        <th>Name</th>
                        <th>price</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Total</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($data as $data)
                        <?php
                                $image_products=DB::table('products')->select('image_name')->join('product_images','product_images.product_id','=','products.id')->where('products.id',$data->product_id)->get()->first();
                                $image_data = DB::table('products')->where('products.id',$data->product_id)->get()->first();
                        ?>
                        
                            <tr >
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
    </div>  
@endsection
@section('jsblock')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.tables.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
      $(document).on('click', '.deleteRecord', function (e) {
          e.preventDefault();
          var id = $(this).data('id');
          swal({
            title: "Are you sure!",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
           },
           function () {
              $.ajax({
                type: "POST",
                url: "admin/courier/"+id,
                data: {id:id},
                success: function (data) {
                              //
                    }         
            });
           });
        });
    </script>
@endsection
