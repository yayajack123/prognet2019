@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Kurir</div>
                    <div class="card-body">
                            <form action="/admin/kurir/{{ $data1->id }}" method="POST">
                                @csrf
                                @method('PUT')
                            <input class="form-control" type="text" name="nama_kurir" value="{{ $data1->courier }}" placeholder="nama kategori"><br>
                                <input type="submit" value="submit" class="btn btn-primary">
                            </form>
                    </div>                
                </div>
            </div>
        </div>
    </div>
@endsection