@extends('layout.layout1')
@section('title','Your Cart')
@section('page',' Cart')
@section('content')
  <legend>Transaction</legend>
        <div class="container">
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td>No</td>
                        <td class="image">Address</td>
                        <td class="description">Total</td>
                        <td class="price">Courier</td>
                        <td class="quantity">Timeout</td>
                        <td class="discount">Payment & Detail</td>
                        
                        <td class="total">Status</td>
                        
                    </tr>
                    </thead>
                    <tbody style="color: black;">
                            {{-- <input type="hidden" name="id" value="{{$cart_data->id}}" id="id-{{$cart_data->id}}">
                            <input type="hidden" name="stock" id="stock" value="{{$cart_data->stock}}"> --}}
                        @foreach($transaction as $transaction)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td class="cart_product">
                                    {{-- @foreach($image_products as $image_product) --}}
                                    <p>{{$transaction->address}}</p>
                                    {{-- @endforeach --}}
                                </td>
                                <td class="cart_description">
                                    <p style="font-size: 15px">Rp {{number_format($transaction->total)}}</p>
                                </td>
                                <td class="cart_price">
                                    <p style="font-size: 15px">{{$transaction->courier}}</p>
                                </td>
                                <td class="cart_quantity">
                                    <p>{{$transaction->timeout}}</p>
                                </td>

                                
                                <td>
                                    <a href="/transaction/{{$transaction->id}}"><button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Payment & Detail</button></a>
                                </td>

                                <td class="cart_total">
                                    @if(!empty($transaction->status))
                                        <p>{{$transaction->status}}</p>
                                    @else
                                        <p>insert Your Payment proof</p>
                                    @endif
                                </td>                 
                            </tr>    
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
@endsection