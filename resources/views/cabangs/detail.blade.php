@extends('layouts.app')

@section('content')
    <div class="content d-flex justify-content-center align-items-center pt-0">
        <div class="container">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Detail Profile</h5>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>
                            <p>{{ $message }}</p>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-body">
                    <form action=# id="myForm">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="name">Nama Cabang</label>
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control" id="title"
                                    aria-describedby="name" readonly value="{{ $cabang->nama_cabang }}">
                            </div>
                        </div>

                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Edit</a>

                        @if (in_array(Auth::user()->role, [1]))
                            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
