@extends('layouts.app')

@section('content')
    <div class="content d-flex justify-content-center align-items-center pt-0">
        <div class="row">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h2 class="card-title">Employees Data</h2>
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
                    <div class="text-right">
                        @if (in_array(Auth::user()->role, [1]))
                            <a class="btn btn-success" href="{{ route('users.create') }}">Add Data</a>
                            <a href="{{ url('/admin_excel') }}" class="btn btn-primary" target="_blank">EXCEL</a>
                        @endif

                        @if (in_array(Auth::user()->role, [2]))
                            <a href="{{ url('/user_excel') }}" class="btn btn-primary" target="_blank">EXCEL</a>
                        @endif

                        <a href="{{ url('/cetak_pdf') }}" class="btn btn-primary" target="_blank">PDF</a>
                    </div>

                    <div class="table-responsive table-scrollable">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>

                                    @if (in_array(Auth::user()->role, [2]))
                                        <th>No HP</th>
                                        <th width="500px">Address</th>
                                    @endif

                                    @if (in_array(Auth::user()->role, [1]))
                                        <th>Role</th>
                                        <th width="230px">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>

                                        @if (in_array(Auth::user()->role, [2]))
                                            <td>{{ $user->no_hp }}</td>
                                            <td>{{ $user->address }}</td>
                                        @endif

                                        @if (in_array(Auth::user()->role, [1]))
                                            <td>{{ config('custom.role.' .$user->role) }}</td>
                                            <td>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">

                                                    <a class="btn btn-info"
                                                        href="{{ route('users.show', $user->id) }}">Set</a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
