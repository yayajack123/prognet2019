@extends('layout.layout1')
@section('title','Your Cart')
@section('page',' Cart')
@section('content')

    <style type="text/css">
        #shipping{
            color: black;
        }
    </style>
    <div class="container">
        <div class="step-one">
            <h2 class="heading">Shipping To</h2>
        </div>
        <div class="row">
            <form action="{{url('/cod')}}" method="post" class="form-horizontal">
                @csrf
                <div class="col-sm-12">
                    <div class="table-responsive" id="shipping">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Telpon</th>
                                <th>Ongkos Kirim</th>
                                <th>Sub Harga</th>
                                <th>Harga Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$data['nama']}}</td>
                                <td>{{$data['alamat']}}</td>
                                <td>{{$data['kota']}}</td>
                                <td>{{$data['provinsi']}}</td>
                                <td>{{$data['telpon']}}</td>
                                <td>{{$data['service']}}</td>
                                <td>Rp {{number_format($data['total_price'])}}</td>
                                <td>Rp {{number_format($total)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <section id="cart_items">
                        <div class="review-payment">
                            <h2>Review & Payment</h2>
                        </div>
                        <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Item</td>
                                    <td class="description"></td>
                                    <td class="price">Price</td>
                                    <td class="quantity">Quantity</td>
                                    <td>Discount</td>
                                    <td class="total">Total</td>
                                </tr>
                                </thead>
                                <tbody style="color: black;">
                                @foreach($cart_datas as $cart_data)
                                   <?php
                                    $image_products=DB::table('products')->select('image_name')->join('product_images','product_images.product_id','=','products.id')->where('products.id',$cart_data->product_id)->get()->first();
                                    $image_data = DB::table('products')->where('products.id',$cart_data->product_id)->get()->first();
                                ?>
                                    <tr>
                                    <td class="cart_product">
                                        <a href=""><img src="{{url('images/small',$image_products->image_name)}}" alt="" style="width: 100px;"></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="">{{$image_data->product_name}}</a></h4>
                                    </td>
                                    <td class="cart_price">
                                        <p>Rp. {{$image_data->price}}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <p>{{$cart_data->qty}}</p>
                                    </td>
                                    <td>
                                        <p>{{$cart_data->percentage}}%</p>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">Rp. {{$cart_data->price*$cart_data->qty}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="2">
                                        <table class="table table-condensed total-result">
                                            <tr>
                                                <td>Cart Sub Total</td>
                                                <td>Rp. {{$data['total_price']}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Total</td>
                                                <td><span>Rp. {{$data['total_price']}}</span></td>
                                            </tr>
                                            
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="payment-options">
                            <button type="submit" class="btn btn-primary" style="float: right;">Order Now</button>
                        </div>
                    </section>
                    @foreach($data as $data)
                        <input type="hidden" name="data[]" value="{{$data}}">
                    @endforeach

                </div>
            </form>
        </div>
    </div>
    <div style="margin-bottom: 20px;"></div>
@endsection