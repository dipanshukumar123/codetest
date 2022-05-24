@extends('admin.layouts.app')

@section('title')
    Settings
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
                        <h4 class="m-0 text-dark">Settings</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
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
                            <div class="card-header">
                                <h3 class="card-title">General<small></small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('admin.settings.update', [$setting]) }}" role="form" id="form" class="needs-validation">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" value="{{ $setting->name }}" class="form-control @error('name') is-invalid @enderror">

                                                @error('name')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Short Name</label>
                                                <input type="text" name="short_name" value="{{ $setting->short_name }}" class="form-control @error('short_name') is-invalid @enderror">

                                                @error('short_name')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div><!-- /.row -->

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Working Time</label>
                                                <input type="text" value="{{ $setting->disp_time }}" class="form-control js-timerange-picker @error('start_time') is-invalid @enderror">
                                                <input type="hidden" name="start_time" value="{{ $setting->start_time }}" class="form-control">
                                                <input type="hidden" name="end_time" value="{{ $setting->end_time }}" class="form-control">

                                                @error('start_time')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Min. Slot Duration</label>
                                                <input type="number" name="min_slot_duration" value="{{ $setting->min_slot_duration }}" class="form-control @error('min_slot_duration') is-invalid @enderror" placeholder="In Minutes">

                                                @error('min_slot_duration')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="tel" name="phone" value="{{ $setting->phone }}" class="form-control @error('phone') is-invalid @enderror">

                                                @error('phone')
                                                <div class="invalid-feedback">
                                                    This field is required
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" value="{{ $setting->email }}" class="form-control @error('email') is-invalid @enderror">

                                                @error('email')
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
                                                <label>Address</label>
                                                <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ $setting->address }}</textarea>

                                                @error('address')
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
                                    <button type="submit" class="btn btn-sm bg-gradient-primary float-right"><i class="fas fa-save"></i>&nbsp; Update</button>
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

    <script>
        $(function () {
            // Time Range Picker
            $('.js-timerange-picker').daterangepicker({
                autoUpdateInput: false,
                timePicker: true,
                timePicker24Hour: false,
                timePickerIncrement: 20,
                timePickerSeconds: false,
                locale: {
                    format: 'hh:mm',
                    separator: " - ",
                    cancelLabel: 'Clear'
                }
            }).on('show.daterangepicker', function (ev, picker) {
                picker.container.find(".calendar-table").hide();
            }).on('apply.daterangepicker', function (ev, picker) {
                if (picker.startDate.format('HH:mm:ss') === picker.endDate.format('HH:mm:ss')) {

                } else {
                    $(this).val(picker.startDate.format('hh:mm A') + '  -  ' + picker.endDate.format('hh:mm A'));

                    $('[name="start_time"]').val(picker.startDate.format('HH:mm:ss'));
                    $('[name="end_time"]').val(picker.endDate.format('HH:mm:ss'));

                    $(this).valid();
                }
            }).on('cancel.daterangepicker', function (ev, picker) {
                $('[name="start_time"]').val('');
                $('[name="end_time"]').val('');

                $(this).val('');
            });
        });
    </script>
@endsection
