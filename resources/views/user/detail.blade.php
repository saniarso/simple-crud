@extends('layouts.app')

@section('content')
    <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4>Detail Profile</h4>
            </div>
        </div>
    </div>

    <div class="content pt-0">
        <div class="card">
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
                        <label class="col-lg-2 col-form-label" for="name">Name</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" class="form-control" id="title"
                                aria-describedby="name" readonly value="{{ @$user->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label" for="username">Username</label>
                        <div class="col-lg-10">
                            <input type="username" name="username" class="form-control" id="username"
                                aria-describedby="username" readonly value="{{ @$user->username }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label" for="email">Email</label>
                        <div class="col-lg-10">
                            <input type="email" name="email" class="form-control" id="email"
                                aria-describedby="email" readonly value="{{ @$user->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label" for="no_hp">No HP</label>
                        <div class="col-lg-10">
                            <input type="number" name="no_hp" class="form-control" id="no_hp"
                                aria-describedby="no_hp" readonly value="{{ @$user->no_hp }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label" for="name">Cabang</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" class="form-control" id="title"
                                aria-describedby="name" readonly value="{{ @$user->cabang->nama_cabang }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label" for="address">Address</label>
                        <div class="col-lg-10">
                            <input type="text" name="address" class="form-control" id="address"
                                aria-describedby="address" readonly value="{{ @$user->address }}">
                        </div>
                    </div>

                    @if (in_array(Auth::user()->role, [1]))
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="username">Role</label>
                            <div class="col-lg-10">
                                <input type="text" name="role" class="form-control" id="role" aria-describedby="role"
                                    readonly value="{{ config('custom.role.' .@$user->role) }}">
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label" for="password">Password</label>
                        <div class="col-lg-10">
                            <input type="password" name="password" class="form-control" id="password"
                                aria-describedby="password" readonly value="********">
                        </div>
                    </div>

                    @if (in_array(Auth::user()->role, [2]))
                        <a href="{{ route('users.edit', @$user->id) }}" class="btn btn-success">Edit</a>
                    @endif

                    @if (in_array(Auth::user()->role, [1]))
                        <a href="{{ route('users.index') }}" class="btn btn-success">Back</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
