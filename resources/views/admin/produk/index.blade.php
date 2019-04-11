@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List Product</div>
                    <div class="card-body">
                            <a href="/admin/produk/create">Tambah Produk</a>
                            <table class="table table-hover">
                                <thead>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Rating</th>
                                    <th>Stok</th>
                                    <th>Berat</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                    
                                </thead>
                                <tbody>
                                    
                                    @foreach($index as $index)
                                    
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$index['product_name']}}</td>
                                        <td>{{$index['price']}}</td>
                                        <td>{{$index['description']}}</td>
                                        <td>{{$index['product_rate']}}</td>
                                        <td>{{$index['stock']}}</td>
                                        <td>{{$index['weight']}}</td>
                                    
                                        <td><img src="{{asset('images/'.$index['image_name']) }}" height="50" width="50" alt="img"></td>
                                        <td><form action="/admin/produk/{{$index->id}}/edit" method="GET">
                                            @csrf
                                            <button class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i>Edit</button>
                                            </form>
                        
                                        </td> 
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection