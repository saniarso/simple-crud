@extends('layouts.app')

@section('content')
    <div class="content d-flex justify-content-center align-items-center pt-0">

        <!-- Register form -->
        <form class="flex-fill" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card mb-0">
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
                            <div class="text-center mb-3">
                                <i
                                    class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Create account</h5>
                                <span class="d-block text-muted">All fields are required</span>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-right">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    placeholder="Username" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-control-feedback">
                                    <i class="icon-user-plus text-muted"></i>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input id="name" type="text" name="name" class="form-control" placeholder="Name">
                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="E-Mail Address">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-control-feedback">
                                            <i class="icon-mention text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input id="address" type="text" name="address" class="form-control" placeholder="Address"
                                            autofocus>
                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input id="no_hp" type="number" name="no_hp" class="form-control" placeholder="Number Phone"
                                            autofocus>
                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-control-feedback">
                                            <i class="icon-lock2 text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="Confirm Password">

                                        <div class="form-control-feedback">
                                            <i class="icon-lock2 text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div id="div-cabang" class="form-group">
                                    <label for="cabang">Cabang</label>
                                    <select name="cabang_id" class="form-control form-control-select2"
                                        data-container-css-class="border-teal" data-dropdown-css-class="border-teal"
                                        require>
                                        @foreach ($cabangs as $cabang)
                                            <option value="{{ $cabang->id }}" > {{ $cabang->nama_cabang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i
                                            class="icon-plus3"></i></b> Register</button>
                            </div>
                            <div class="form-group text-center text-muted content-divider">
                                <span class="px-2">Already have an account?</span>
                            </div>

                            <div class="form-group">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-block">Sign in</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /register form -->
    </div>
@endsection
