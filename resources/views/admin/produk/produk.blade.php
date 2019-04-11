@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Kurir</div>
                    <div class="card-body">
                            <form action="/kurir" method="POST">
                                @csrf
                                <input class="form-control" type="text" name="nama_kurir" placeholder="nama kurir" required><br>
                                <input type="submit" value="submit" class="btn btn-primary">
                            </form>
                    </div>                
                </div>
            </div>
        </div>
    </div>

@endsection