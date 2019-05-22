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
            <h5>Approvement</h5>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>Corier</th>
                    <th>Timeout</th>
                    <th>Detail</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transaction as $index)
                
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$index->name}}</td>
                    <td>{{$index->address}}</td>
                    <td>Rp {{number_format($index->total)}}</td>
                    <td>{{$index->courier}}</td>
                    <td>{{$index->timeout}}</td>
                    <td>
                        <center><a href="/admin/transactionAdmin/{{$index->id}}"><button class="btn-success">Detail & Verify</button></a></center>
                    </td>
                    <td>{{$index->status}}</td>
                    
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