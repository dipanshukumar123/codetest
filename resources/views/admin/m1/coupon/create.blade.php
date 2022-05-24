@extends('admin.layouts.app')

@section('title')
    Create
@endsection

@section('styles')
    @parent

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class=" content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">Create</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item">Spinning Cycle</li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.m1.coupons.index') }}">Coupons</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card card-primary card-outline">
                            <!-- form start -->
                            <form method="POST" action="{{ route('admin.m1.coupons.store') }}" role="form" autocomplete="off" enctype="multipart/form-data" id="form" class="needs-validation">
                                @csrf

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">

                                                @error('name')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Code</label>
                                                <input type="text" name="code" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror" onkeyup="this.value = this.value.toUpperCase();">

                                                @error('code')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('code') }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Discount Type</label>
                                                <select name="discount_type" class="form-control @error('discount_type') is-invalid @enderror">
                                                    <option value="">Select Discount Type</option>
                                                    <option value="1" @if(old('discount_type') == '1') selected @endif>Fixed</option>
                                                    <option value="2" @if(old('discount_type') == '2') selected @endif>Percentage</option>
                                                </select>

                                                @error('discount_type')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Amount/Percentage</label>
                                                <input type="text" name="discount" value="{{ old('discount') }}" class="form-control @error('discount') is-invalid @enderror">

                                                @error('discount')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Total Usage</label>
                                                <input type="number" name="total_usage" value="{{ old('total_usage') }}" class="form-control @error('total_usage') is-invalid @enderror">

                                                @error('total_usage')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Usage Per User</label>
                                                <input type="number" name="usage_per_user" value="{{ old('usage_per_user') }}" class="form-control @error('usage_per_user') is-invalid @enderror">

                                                @error('usage_per_user')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Validity</label>
                                                <input type="text" name="validity" value="{{ old('validity') }}" class="form-control js-daterange-picker @error('start_date') is-invalid @enderror">
                                                <input type="hidden" name="start_date" value="{{ old('start_date') }}" class="form-control">
                                                <input type="hidden" name="end_date" value="{{ old('end_date') }}" class="form-control">

                                                @error('start_date')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                    <option value="">Select Status</option>
                                                    <option value="1" @if(old('status') == '1') selected @endif>Active</option>
                                                    <option value="0" @if(old('status') == '0') selected @endif>Inactive</option>
                                                </select>

                                                @error('status')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm bg-gradient-primary float-right"><i class="fas fa-save"></i>&nbsp; Save</button>
                                </div>
                            </form>
                        </div>
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

    <script type="text/javascript">
        $('.js-daterange-picker').daterangepicker({
            showDropdowns: true,
            autoUpdateInput: false,
            applyClass: "btn-primary",
            locale: {
                format: 'DD-MM-YYYY',
                separator: "-",
                cancelLabel: 'Clear'
            }
        }, function (start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        }).on('apply.daterangepicker', function (ev, picker) {
            if (moment(picker.startDate.format('YYYY-MM-DD')).isSame(picker.endDate.format('YYYY-MM-DD'))) {
                $(this).val(picker.startDate.format('DD-MM-YYYY'));
            } else {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + '  -  ' + picker.endDate.format('DD-MM-YYYY'));
            }

            $('input[name="start_date"]').val(picker.startDate.format('YYYY-MM-DD'));
            $('input[name="end_date"]').val(picker.endDate.format('YYYY-MM-DD'));
        }).on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
            $('input[name="start_date"]').val('');
            $('input[name="end_date"]').val('');
        });
    </script>
@endsection
