@extends('layouts.app')
@section('content')
    
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done!</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Review Products</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>User</th>
                        <th>Rate</th>
                        <th>Comment</th>
                        <th>Reply</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($response as $response)
                        <tr class="gradeC">
                            <td>{{$loop->iteration}}</td>
                            <td style="vertical-align: middle;">{{$response->product_name}}</td>
                            <td style="vertical-align: middle;">{{$response->user_id}}</td>
                            <td style="vertical-align: middle;text-align: center;">{{$response->rate}}</td>
                            
                            <td style="vertical-align: middle;">{{$response->content}}</td>
                            
                            <td style="text-align: center;">
                                @if($response->status == NULL)
                                    <a href="/admin/createResponse/{{$response->id}}"><button class="btn btn-success">reply</button></a>
                                @else
                                    <p>Replied</p>
                                @endif
                            </td>
                            <td style="width: 12%; text-align: center;">
                                {{-- <div class="btn-group"> --}}
                                    
                                    {{-- <form action="/response/{{$index->id}}/" method="POST">
                                    @method("DELETE")
                                    @csrf --}}
                                    <button type="submit" class="btn btn-danger" >Delete<i class="fa fa-trash-o fa-fw" ></i>
                                {{-- </button> --}}
                                </div>
                            {{-- </form> --}}
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
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.tables.js')}}"></script>
    <script src="{{asset('js/matrix.popover.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(".btn-outline-danger").click(function () {
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