@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Produk</div>
                    <div class="card-body">

                            <form action="/admin/produk/{{$test->id}}" method="POST" >
                                {{csrf_field()}}
                                @method("PUT")
                                <input type="text" name="nama_produk" value="{{$test->product_name}}" required="" class="form-control"><br>
                                <input type="number" name="harga" value="{{$test->price}}" required="" class="form-control"><br>
                                <input type="text" name="deskripsi" value="{{$test->description}}" required="" class="form-control"><br>
                                <input type="number" name="rating" value="{{$test->product_rate}}" required=""class="form-control"><br>
                                <input type="number" name="stok" value="{{$test->stock}}" required=""class="form-control"><br>
                                <input type="number" name="berat" value="{{$test->weight}}" required="" class="form-control"><br>
                                <input type="submit" name="submit" value="update">
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
    