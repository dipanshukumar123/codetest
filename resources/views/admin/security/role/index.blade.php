@extends('admin.layouts.app')

@section('title')
    Roles
@endsection

@section('styles')
    @parent

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">Roles</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item">Security</li>
                            <li class="breadcrumb-item active">Roles</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row align-items-center mt-2">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('admin.security.roles.create') }}" class="btn btn-sm bg-gradient-primary float-right"><i class="fas fa-plus"></i>&nbsp; Add New</a>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table" id="table" style="margin: 0 !important;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Options</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    @parent

    @stack('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#table').DataTable({
                lengthChange: false,
                searching: false,
                info: false,
                paging: false,
                searchHighlight: false,
                ordering: false,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                stateSave: false,
                deferRender: true,
                lengthMenu: [[10, 25, 50, 100, 1000], [10, 25, 50, 100, 1000]],
                pageLength: 50,
                order: [[0, 'DESC']],
                columnDefs: [
                    {orderable: false, targets: [0, 1, 2]},
                    {className: 'text-center', targets: [0, 2]},
                    {width: '30px', targets: 0},
                    {width: '30px', targets: 2}
                ],
                ajax: {
                    url: '{{ route('admin.security.roles.index') }}',
                    dataType: 'json',
                    type: 'GET',
                    data: function (d) {

                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'options'}
                ]
            });

        });
    </script>
@endsection
