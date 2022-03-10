@extends('layouts.app')

@section('content')
    <div class="content d-flex justify-content-center align-items-center pt-0">
        <div class="container mt-5">
            <div class="row justify-content-center align-items-center">
                <div class="card" style="width: 30rem;">
                    <div class="card-header">
                        Add Data
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

                        <form method="post" action="{{ route('cabang.store') }}" id="myForm">
                            @csrf
                            <div class="form-group">
                                <label for="nama_cabang">Nama Cabang</label>
                                <input type="text" name="nama_cabang" class="form-control" id="nama_cabang" aria-describedby="nama_cabang"
                                    placeholder="Nama Cabang">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('cabang.index') }}" class="btn btn-default">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

    <script>
        var InputsBasic = function () {

        //
        // Setup module components
        //

        // Uniform
        var _componentUniform = function() {
            if (!$().uniform) {
                console.warn('Warning - uniform.min.js is not loaded.');
                return;
            }

            // File input
            $('.form-control-uniform').uniform();

            // Custom select
            $('.form-control-uniform-custom').uniform({
                fileButtonClass: 'action btn bg-blue',
                selectClass: 'uniform-select bg-pink-400 border-pink-400'
            });
        };

        //
        // Return objects assigned to module
        //

        return {
            init: function() {
                _componentUniform();
            }
        }
        }();
    </script>
@endsection
