@extends('layout.layout1')
@section('title','Your Cart')
@section('page',' Cart')
@section('content')
<div class="container"><legend>Transaction</legend></div>
<section id="cart-view">
  <div class="container">
        <div class="cart-view-area">
        <div class="cart-view-table">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>No</td>
                        <td >Address</td>
                        <td >Total</td>
                        <td >Courier</td>
                        <td >Timeout</td>
                        <td >Payment & Detail</td>
                        <td >Status</td>
                        
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
                                <td >
                                    {{-- @foreach($image_products as $image_product) --}}
                                    <p>{{$transaction->address}}</p>
                                    {{-- @endforeach --}}
                                </td>
                                <td>
                                    <p style="font-size: 15px">Rp {{number_format($transaction->total)}}</p>
                                </td>
                                <td>
                                    <p style="font-size: 15px">{{$transaction->courier}}</p>
                                </td>
                                <td>
                                    <p>{{$transaction->timeout}}</p>
                                </td>

                                
                                <td>
                                    <a href="/transaction/{{$transaction->id}}"><button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Payment & Detail</button></a>
                                </td>

                                <td >
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
    </div>
  </div>
</section>
@endsection