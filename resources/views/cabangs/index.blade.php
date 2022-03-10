@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4>Branches Data</h4>
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
                    <a href="{{ url('/pdf_cabang') }}" class="btn btn-default"><i class="icon-file-pdf"></i> Export to .pdf</a>

                    @if (in_array(Auth::user()->role, [1]))
                        <a href="{{ url('/cabang_excel') }}" class="btn btn-default"><i class="icon-file-excel"></i> Export to .xlsx</a>
                        <a class="btn btn-success" href="{{ route('cabang.create') }}">Add Data</a>
                    @endif
                </div>

                <table class="table datatable-basic table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Cabang</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cabangs as $cabang)
                            <tr>
                                <td>{{ $cabang->nama_cabang }}</td>

                                <td class="text-center" style="white-space: nowrap">
                                    @if (in_array(Auth::user()->role, [1]))
                                        <a class="btn btn-default" href="{{ route('cabang.show', $cabang->id) }}" title="Show"><i class="icon-eye8"></i></a>
                                        <a class="btn btn-default" href="{{ route('cabang.edit', $cabang->id) }}" title="Edit"><i class="icon-pencil7"></i></a>
                                        <a class="btn btn-danger" data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('delete-cabang', $cabang->id) }}" title="Delete">
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
@endsection

@section('js')
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

    <script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

    <script>
        var DatatableBasic = function() {

            //
            // Setup module components
            //

            // Basic Datatable examples
            var _componentDatatableBasic = function() {
                if (!$().DataTable) {
                    console.warn('Warning - datatables.min.js is not loaded.');
                    return;
                }

                // Setting datatable defaults
                $.extend( $.fn.dataTable.defaults, {
                    autoWidth: false,
                    columnDefs: [{
                        orderable: false,
                        width: 100,
                        targets: [ 1 ]
                    }],
                    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>Search:</span> _INPUT_',
                        searchPlaceholder: 'Type to search...',
                        lengthMenu: '<span>Show:</span> _MENU_',
                        paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                    }
                });

                // Basic datatable
                $('.datatable-basic').DataTable();

                // Datatable with saving state
                $('.datatable-save-state').DataTable({
                    stateSave: true
                });

                // Scrollable datatable
                var table = $('.datatable-scroll-y').DataTable({
                    autoWidth: true,
                    scrollY: 300
                });

                // Resize scrollable table when sidebar width changes
                $('.sidebar-control').on('click', function() {
                    table.columns.adjust().draw();
                });
            };

            // Select2 for length menu styling
            var _componentSelect2 = function() {
                if (!$().select2) {
                    console.warn('Warning - select2.min.js is not loaded.');
                    return;
                }

                // Initialize
                $('.dataTables_length select').select2({
                    minimumResultsForSearch: Infinity,
                    dropdownAutoWidth: true,
                    width: 'auto'
                });
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function() {
                    _componentDatatableBasic();
                    _componentSelect2();
                }
            }
        }();

        // Initialize module
        // ------------------------------

        document.addEventListener('DOMContentLoaded', function() {
            DatatableBasic.init();
        });
    </script>
@endsection
