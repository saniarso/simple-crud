@extends('layouts.app')

@section('content')
    <div class="content d-flex justify-content-center align-items-center pt-0">
        <div class="container mt-5">
            <div class="row justify-content-center align-items-center">
                <div class="card" style="width: 30rem;">
                    <div class="card-header">
                        Edit Data
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post" action="{{ route('users.update', @$user->id) }}" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="title" aria-describedby="name"
                                    value="{{ @$user->name }}">
                            </div>
                            <div class="form-group">
                                @if (in_array(Auth::user()->role, [1]))
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" aria-describedby="username"
                                        value="{{ @$user->username }}" required autocomplete="username">
                                @endif
                                @if (in_array(Auth::user()->role, [2]))
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" aria-describedby="username"
                                        readonly value="{{ @$user->username }}" required autocomplete="username">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                @if (in_array(Auth::user()->role, [1]))
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="email"
                                        value="{{ @$user->email }}" required autocomplete="email">
                                @endif
                                @if (in_array(Auth::user()->role, [2]))
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="email"
                                        readonly value="{{ @$user->email }}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input type="number" name="no_hp" class="form-control" id="no_hp" aria-describedby="no_hp"
                                    value="{{ @$user->no_hp }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    aria-describedby="address" value="{{ @$user->address }}">
                            </div>

                            @if (in_array(Auth::user()->role, [1]))
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control form-control-select2"
                                        data-container-css-class="border-teal" data-dropdown-css-class="border-teal"
                                        require>
                                        <option value="" ></option>
                                        @foreach (config('custom.role') as $key => $value)
                                            <option {{ $user->role == $key ? 'selected' : '' }} value="{{ $key }}" > {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cabang">Cabang</label>
                                    <select name="cabang_id" class="form-control form-control-select2"
                                        data-container-css-class="border-teal" data-dropdown-css-class="border-teal"
                                        require>
                                        <option value="" ></option>
                                        @foreach ($cabangs as $cabang)
                                            <option {{ $user->cabang_id == $cabang->id ? 'selected' : '' }} value="{{ $cabang->id }}" > {{ $cabang->nama_cabang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    aria-describedby="password" value="">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            @if (in_array(Auth::user()->role, [1]))
                                <a href="{{ url('/users') }}" class="btn btn-default">Back</a>
                            @endif
                            @if (in_array(Auth::user()->role, [2]))
                                <a href="{{ route('users.show', Auth::user()->id) }}" class="btn btn-default">Back</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
