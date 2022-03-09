@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4>Employees Data</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>
    <!-- /page header -->

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
                <div class="text-right">
                    <a href="{{ url('/cetak_pdf') }}" class="btn btn-default"><i class="icon-file-pdf"></i> Export to .pdf</a>

                    @if (in_array(Auth::user()->role, [2]))
                        <a href="{{ url('/user_excel') }}" class="btn btn-default"><i class="icon-file-excel"></i> Export to .xlsx</a>
                    @endif

                    @if (in_array(Auth::user()->role, [1]))
                        <a href="{{ url('/admin_excel') }}" class="btn btn-default"><i class="icon-file-excel"></i> Export to .xlsx</a>
                        <a class="btn btn-success" href="{{ route('users.create') }}">Add Data</a>
                    @endif
                </div>

                <table class="table datatable-basic table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Cabang</th>
                            <th>Username</th>
                            <th>Email</th>

                            @if (in_array(Auth::user()->role, [2]))
                                <th>Address</th>
                            @endif

                            @if (in_array(Auth::user()->role, [1]))
                                <th>Role</th>
                            @endif

                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ @$user->name }}</td>
                                <td>{{ @$user->cabang->nama_cabang }}</td>
                                <td>{{ @$user->username }}</td>
                                <td>{{ @$user->email }}</td>

                                @if (in_array(Auth::user()->role, [2]))
                                    <td>{{ @$user->address }}</td>
                                @endif

                                @if (in_array(Auth::user()->role, [1]))
                                    <td>{{ config('custom.role.' .@$user->role) }}</td>
                                @endif

                                <td class="text-center" style="white-space: nowrap">


                                    @if (in_array(Auth::user()->role, [1]))
                                        <a class="btn btn-default" href="{{ route('users.show', @$user->id) }}" title="Show"><i class="icon-eye8"></i></a>
                                        <a class="btn btn-default" href="{{ route('users.edit', @$user->id) }}" title="Edit"><i class="icon-pencil7"></i></a>
                                        <a class="btn btn-danger" data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('delete', @$user->id) }}" title="Delete">
                                            <i class="icon-cross2"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- small modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // display a modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href
                , beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                }
                , complete: function() {
                    $('#loader').hide();
                }
                , error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                }
                , timeout: 8000
            })
        });

    </script>
@endsection
