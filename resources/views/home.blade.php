@extends('layouts.app')

@section('content')
    @if (Route::has('login'))
        @auth
        <div class="content d-flex justify-content-center align-items-center pt-0">
            <div class="container">
                <div class="row justify-content-center full-height">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Dashboard</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                You are logged in!
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endauth
    @endif
@endsection
