@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Produk</div>
                    <div class="card-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                                @endif

                                    @if(session('success'))
                                    <div class="alert alert-success">
                                    {{ session('success') }}
                                    </div> 
                                    @endif


                            <form action="/admin/produk" enctype="multipart/form-data" method="POST">
                                @csrf
                                Nama :
                                <input type="text" name="nama_produk" required="" class="form-control"><br>
                                Harga : 
                                <input type="number" name="harga" required="" class="form-control"><br>
                                Rating : 
                                <input type="number" name="rating" required="" class="form-control"><br>
                                Stok : 
                                <input type="number" name="stok" required="" class="form-control"><br>
                                Berat : 
                                <input type="number" name="berat" required="" class="form-control"><br>
                                kategori : 
                                @foreach ($kategori as $category)
                                    <input type="checkbox" name="kategori[]" value="{{$category->id}}">{{$category->category_name}}  
                                @endforeach
                                <br><br>
                                Foto:
                                <div class="input-group control-group increment" >
                                    <input type="file" name="filename[]" class="form-control">
                                <div class="input-group-btn"> 
                                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                </div>
                                </div>
                        <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn"> 
                            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                            </div>
                        </div>
                        </div>
                        <br>
                        Deskripsi : <input type="text" name="deskripsi" required="" class="form-control"><br>

                        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
                            </form>
                            <script type="text/javascript">


                                $(document).ready(function() {
                            
                                  $(".btn-success").click(function(){ 
                                      var html = $(".clone").html();
                                      $(".increment").after(html);
                                  });
                            
                                  $("body").on("click",".btn-danger",function(){ 
                                      $(this).parents(".control-group").remove();
                                  });
                            
                                });
                            
                            </script>
                    </div>                
                </div>
            </div>
        </div>
    </div>

@endsection