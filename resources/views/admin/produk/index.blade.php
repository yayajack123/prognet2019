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
                                        </form>
                                        <form style="float: right;" action="/admin/produk/{{$index->id}}/" method="POST">
                                        @method("DELETE")
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete<i class="fa fa-trash-o fa-fw" onclick="return confirm('Yakin ingin menghapus data?')"></i>
                                        </button>
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
@section('jsblock')
    {{-- <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.tables.js')}}"></script>
    <script src="{{asset('js/matrix.popover.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(".deleteRecord").click(function () {
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
                window.location.href="/admin/"+deleteFunction+"/"+id;
            });
        });
    </script>
@endsection