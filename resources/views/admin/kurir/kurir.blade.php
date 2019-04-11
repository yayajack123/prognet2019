@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Kurir</div>
                    <div class="card-body">
                            <form action="/admin/kurir" method="POST">
                                @csrf
                                <input class="form-control" type="text" name="nama_kurir" placeholder="nama kurir" required><br>
                                <input type="submit" value="submit" class="btn btn-primary">
                            </form>
                    </div>                
                </div>
                <br>
                <div class="card">
                        <div class="card-header">List kurir</div>
                        <div class="card-body">
                                <div class="table-responsive">
                                        <table class="table table-striped ">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>List kurir</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $m)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td> {{ $m->courier }}</td>
                                                        <td>
                                                            <form action="/kurir/{{$m->id}}/edit" method="GET">
                                                                @csrf
                                                                <button type="submit" class="btn btn-warning">
                                                                    Edit
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="/kurir/{{$m->id}}/" method="POST">
                                                                @method("DELETE")
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">
                                                                    DELETE
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
    </div>

@endsection