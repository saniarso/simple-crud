@extends('layouts.app')

@section('content')
    <div class="content d-flex justify-content-center align-items-center pt-0">
        <div class="container mt-5">
            <div class="row justify-content-center align-items-center">
                <div class="card" style="width: 30rem;">
                    <div class="card-header">
                        Create Data
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
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="post" action="{{ route('users.store') }}" id="myForm">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name"
                                    placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" name="username" class="form-control" id="username" aria-describedby="username"
                                    placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="E-Mail Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Phone Number</label>
                                <input type="number" name="no_hp" class="form-control" id="no_hp" aria-describedby="no_hp"
                                    placeholder="Enter your number phone">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    aria-describedby="address" placeholder="Enter your address">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    aria-describedby="password" placeholder="Enter your password">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control form-control-select2"
                                    data-container-css-class="border-teal" data-dropdown-css-class="border-teal"
                                    required>
                                    @foreach (config('custom.role') as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cabang">Cabang</label>
                                <select name="cabang_id" class="form-control form-control-select2"
                                    data-container-css-class="border-teal" data-dropdown-css-class="border-teal"
                                    require>
                                    @foreach ($cabangs as $cabang)
                                        <option value="{{ $cabang->id }}" > {{ $cabang->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
