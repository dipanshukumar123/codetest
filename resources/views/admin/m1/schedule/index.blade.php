@extends('admin.layouts.app')

@section('title')
    Schedule
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
                        <h4 class="m-0 text-dark">
                            Schedule
                            <small><b>{{ $class->name }}</b></small>
                        </h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item">Spinning Cycle</li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.m1.classes.index') }}">Classes</a></li>
                            <li class="breadcrumb-item active">Schedule</li>
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <form method="POST" action="{{ route('admin.m1.classes.schedule.store', $class) }}" role="form" id="addScheduleForm" class="needs-validation" autocomplete="off">
                                @csrf

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Date</label>
                                            <input type="text" name="date" class="form-control js-daterange-picker" placeholder="Default">
                                            <input type="hidden" name="start_date" class="form-control">
                                            <input type="hidden" name="end_date" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Duration (in Minutes)</label>
                                            <input type="text" name="duration" class="form-control" value="{{ $class->duration }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="well m-b-15 p-l-15 p-t-10 p-r-15 p-b-10">
                                                <div class="row">
                                                    <div class="form-group col-md-12 m-b-0">
                                                        <label>Weekdays</label>
                                                    </div>
                                                </div>
                                                @if (in_array(0, $working_days))
                                                    <div class="row">
                                                        <div class="form-group col-md-2">
                                                            <div class="icheck-primary" style="margin-top: 2.3rem!important;">
                                                                <input type="checkbox" name="sunday" value="0" id="chb_0">
                                                                <label for="chb_0" class="m-l-5">Sunday</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Slots</label>
                                                            <select name="sunday_time" class="form-control js-select2">
                                                                <option value="">Select Slot</option>
                                                                @foreach ($slots as $item)
                                                                    <option value="{{ $item[0] }}">{{ $item[1] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="time-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>No. of Cycles</label>
                                                            <input type="number" name="sunday_num_seats" value="{{ $class->num_seats }}" min="0" class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3" id="sunday_coach">
                                                            <label>Coach</label>
                                                            <select name="sunday_coach" class="form-control js-select2">
                                                                <option Inactive value="">Select Coach</option>
                                                                @foreach ($coaches as $item)
                                                                    <option value="{{ $item['id'] }}">{{ $item['first_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="coach-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>Status</label>
                                                            <select name="sunday_status" class="form-control js-select2">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (in_array(1, $working_days))
                                                    <div class="row">
                                                        <div class="form-group col-md-2">
                                                            <div class="icheck-primary" style="margin-top: 2.3rem!important;">
                                                                <input type="checkbox" name="monday" value="1" id="chb_1">
                                                                <label for="chb_1" class="m-l-5">Monday</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Slots</label>
                                                            <select name="monday_time" class="form-control js-select2">
                                                                <option value="">Select Slot</option>
                                                                @foreach ($slots as $item)
                                                                    <option value="{{ $item[0] }}">{{ $item[1] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="time-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>No. of Cycles</label>
                                                            <input type="number" name="monday_num_seats" value="{{ $class->num_seats }}" min="0" class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3" id="monday_coach">
                                                            <label>Coach</label>
                                                            <select name="monday_coach" class="form-control js-select2">
                                                                <option Inactive value="">Select Coach</option>
                                                                @foreach ($coaches as $item)
                                                                    <option value="{{ $item['id'] }}">{{ $item['first_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="coach-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>Status</label>
                                                            <select name="monday_status" class="form-control js-select2">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (in_array(2, $working_days))
                                                    <div class="row">
                                                        <div class="form-group col-md-2">
                                                            <div class="icheck-primary" style="margin-top: 2.3rem!important;">
                                                                <input type="checkbox" name="tuesday" value="2" id="chb_2">
                                                                <label for="chb_2" class="m-l-5">Tuesday</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Slots</label>
                                                            <select name="tuesday_time" class="form-control js-select2">
                                                                <option value="">Select Slot</option>
                                                                @foreach ($slots as $item)
                                                                    <option value="{{ $item[0] }}">{{ $item[1] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="time-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>No. of Cycles</label>
                                                            <input type="number" name="tuesday_num_seats" value="{{ $class->num_seats }}" min="0" class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3" id="tuesday_coach">
                                                            <label>Coach</label>
                                                            <select name="tuesday_coach" class="form-control js-select2">
                                                                <option Inactive value="">Select Coach</option>
                                                                @foreach ($coaches as $item)
                                                                    <option value="{{ $item['id'] }}">{{ $item['first_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="coach-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>Status</label>
                                                            <select name="tuesday_status" class="form-control js-select2">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (in_array(3, $working_days))
                                                    <div class="row">
                                                        <div class="form-group col-md-2">
                                                            <div class="icheck-primary" style="margin-top: 2.3rem!important;">
                                                                <input type="checkbox" name="wednesday" value="3" id="chb_3">
                                                                <label for="chb_3" class="m-l-5">Wednesday</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Slots</label>
                                                            <select name="wednesday_time" class="form-control js-select2">
                                                                <option value="">Select Slot</option>
                                                                @foreach ($slots as $item)
                                                                    <option value="{{ $item[0] }}">{{ $item[1] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="time-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>No. of Cycles</label>
                                                            <input type="number" name="wednesday_num_seats" value="{{ $class->num_seats }}" min="0" class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3" id="wednesday_coach">
                                                            <label>Coach</label>
                                                            <select name="wednesday_coach" class="form-control js-select2">
                                                                <option Inactive value="">Select Coach</option>
                                                                @foreach ($coaches as $item)
                                                                    <option value="{{ $item['id'] }}">{{ $item['first_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="coach-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>Status</label>
                                                            <select name="wednesday_status" class="form-control js-select2">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (in_array(4, $working_days))
                                                    <div class="row">
                                                        <div class="form-group col-md-2">
                                                            <div class="icheck-primary" style="margin-top: 2.3rem!important;">
                                                                <input type="checkbox" name="thursday" value="4" id="chb_4">
                                                                <label for="chb_4" class="m-l-5">Thursday</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Slots</label>
                                                            <select name="thursday_time" class="form-control js-select2">
                                                                <option value="">Select Slot</option>
                                                                @foreach ($slots as $item)
                                                                    <option value="{{ $item[0] }}">{{ $item[1] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="time-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>No. of Cycles</label>
                                                            <input type="number" name="thursday_num_seats" value="{{ $class->num_seats }}" min="0" class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3" id="thursday_coach">
                                                            <label>Coach</label>
                                                            <select name="thursday_coach" class="form-control js-select2">
                                                                <option Inactive value="">Select Coach</option>
                                                                @foreach ($coaches as $item)
                                                                    <option value="{{ $item['id'] }}">{{ $item['first_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="coach-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>Status</label>
                                                            <select name="thursday_status" class="form-control js-select2">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (in_array(5, $working_days))
                                                    <div class="row">
                                                        <div class="form-group col-md-2">
                                                            <div class="icheck-primary" style="margin-top: 2.3rem!important;">
                                                                <input type="checkbox" name="friday" value="5" id="chb_5">
                                                                <label for="chb_5" class="m-l-5">Friday</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Slots</label>
                                                            <select name="friday_time" class="form-control js-select2">
                                                                <option value="">Select Slot</option>
                                                                @foreach ($slots as $item)
                                                                    <option value="{{ $item[0] }}">{{ $item[1] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="time-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>No. of Cycles</label>
                                                            <input type="number" name="friday_num_seats" value="{{ $class->num_seats }}" min="0" class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3" id="friday_coach">
                                                            <label>Coach</label>
                                                            <select name="friday_coach" class="form-control js-select2">
                                                                <option Inactive value="">Select Coach</option>
                                                                @foreach ($coaches as $item)
                                                                    <option value="{{ $item['id'] }}">{{ $item['first_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="coach-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>Status</label>
                                                            <select name="friday_status" class="form-control js-select2">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (in_array(6, $working_days))
                                                    <div class="row">
                                                        <div class="form-group col-md-2">
                                                            <div class="icheck-primary" style="margin-top: 2.3rem!important;">
                                                                <input type="checkbox" name="saturday" value="6" id="chb_6">
                                                                <label for="chb_6" class="m-l-5">Saturday</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Slots</label>
                                                            <select name="saturday_time" class="form-control js-select2">
                                                                <option value="">Select Slot</option>
                                                                @foreach ($slots as $item)
                                                                    <option value="{{ $item[0] }}">{{ $item[1] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="time-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>No. of Cycles</label>
                                                            <input type="number" name="saturday_num_seats" value="{{ $class->num_seats }}" min="0" class="form-control" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3" id="saturday_coach">
                                                            <label>Coach</label>
                                                            <select name="saturday_coach" class="form-control js-select2">
                                                                <option Inactive value="">Select Coach</option>
                                                                @foreach ($coaches as $item)
                                                                    <option value="{{ $item['id'] }}">{{ $item['first_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="coach-error"></span>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>Status</label>
                                                            <select name="saturday_status" class="form-control js-select2">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-2">
                                        <div class="col-md-6">
                                            <button type="button" id="clear" class="btn btn-sm bg-gradient-danger ">Clear</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-sm bg-gradient-primary float-right" id="storeBtnSave">
                                                <i class="fa fa-save m-r-5"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Weekday</th>
                                                <th>Cycles</th>
                                                <th>Coach</th>
                                                <th>Status</th>
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
            </div>
        </div>
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    {{--  Modal  --}}
    <div class="modal fade" id="defaultModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" role="form" id="editScheduleForm" class="needs-validation">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" name="update_url" class="form-control">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Date</label>
                                <div class="input-group date" id="js_datetimepicker" data-target-input="nearest">
                                    <input type="text" name="edit_date" class="form-control datetimepicker-input" data-target="#js_datetimepicker" data-toggle="datetimepicker"/>
                                </div>
                                <input type="hidden" name="schedule_date" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Slots</label>
                                <select name="start_time" class="form-control js-select2">
                                    <option value="">Select Slot</option>
                                    @foreach ($slots as $item)
                                        <option value="{{ $item[0] }}">{{ $item[1] }}</option>
                                    @endforeach
                                </select>
                                <span class="slot-error"></span>
                            </div>
                            <div class="form-group col-md-12" id="coach_id">
                                <label>Coach</label>
                                <select name="coach_id" class="form-control js-select2">
                                    @foreach ($coaches as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['first_name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="coach-error"></span>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Status</label>
                                <select name="status" class="form-control js-select2">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary" id="editBtnSave">
                            <i class="fa fa-save m-r-5"></i> Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('scripts')
    @parent

    @stack('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            var weekdays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

            //initialize Select2
            $('.js-select2').select2({
                minimumResultsForSearch: -1,
                width: '100%'
            });

            // Clear Search
            $('#clear').click(function (e) {
                $('[name="date"]').val('');
                $('[name="start_date"]').val('');
                $('[name="end_date"]').val('');
                $('.js-daterange-picker').data('daterangepicker').setStartDate(moment().format('DD/MM/YYYY'));
                $('.js-daterange-picker').data('daterangepicker').setEndDate(moment().format('DD/MM/YYYY'));

                $.each(weekdays, function (key, weekday) {
                    $('#chb_' + key).prop("checked", false);

                    $('[name="' + weekday + '_time"]').val('').trigger('change');
                    $('[name="' + weekday + '_coach"]').val('').trigger('change');
                    $('[name="' + weekday + '_status"]').val('1').trigger('change');
                });

                table.draw(false);
            });

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


            // Form validations for Add Schedule
            var validator = $('#addScheduleForm').validate({
                rules: {
                    date: {
                        required: true
                    }
                },
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    var data = $("#addScheduleForm").serialize();

                    $.ajax({
                        url: '{{ route('admin.m1.classes.schedule.store', $class) }}',
                        type: 'POST',
                        data: data,
                        success: function (data) {
                            table.draw(false);
                        },
                        error: function (result) {
                        }
                    });
                }
            });

            //add schedule
            $('#storeBtnSave').on('click', function () {
                if ($("#addScheduleForm").valid()) {
                    $("#addScheduleForm").submit();
                }
            });

            $('#js_datetimepicker').datetimepicker({
                format: 'DD-MM-YYYY',
                showClear: true,
                useCurrent: false,
                ignoreReadonly: true,
            });

            $("#js_datetimepicker").on("change.datetimepicker", ({date, oldDate}) => {
                date ? $('[name="schedule_date"]').val(moment(date).format('YYYY-MM-DD')) : $('[name="schedule_date"]').val('');
            });


            // Edit Form validations
            var validator1 = $('#editScheduleForm').validate({
                rules: {
                    edit_date: {
                        required: true
                    },
                    start_time: {
                        required: true
                    },
                    coach_id: {
                        required: true
                    }
                },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorPlacement: function (error, element) {
                    if (element.attr('name') == 'start_time') {
                        error.insertAfter('.slot-error');
                    } else if (element.attr('name') == 'area_id') {
                        error.insertAfter('.edit-area-error');
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    var url = $('[name="update_url"]').val();
                    var data = $("#editScheduleForm").serialize();

                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: data,
                        success: function (data) {
                            table.draw(false);
                            $('#defaultModal').modal('hide');
                        },
                        error: function (result) {
                        }
                    });
                }
            });

            //edit schedule
            $('#editBtnSave').on('click', function () {
                if ($("#editScheduleForm").valid()) {
                    $("#editScheduleForm").submit();
                }
            });

            // Edit
            $(document).on('click', '.edit', function (e) {
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'GET',
                    success: function (res) {
                        populateForm(res);
                        $('#defaultModal').modal('show');
                    }
                });
            });

            // Reset form when modal hides
            $('#defaultModal').on('hide.bs.modal', function () {
                resetForm();
            });

            // Populate form with backend object
            function populateForm(data) {
                $('[name="update_url"]').val(data.update_url);
                $('[name="edit_date"]').val(moment(data.start_date).format('DD-MM-YYYY'));
                $('[name="schedule_date"]').val(moment(data.start_date).format('YYYY-MM-DD'));
                $('[name="start_time"]').val(data.start_time).trigger('change');
                $('[name="coach_id"]').val(data.coach_id).trigger('change');
                $('[name="status"]').val(data.status).trigger('change');
            }

            // Reset form
            function resetForm() {
                $('#js_datetimepicker').data("datetimepicker").clear();
                $('[name="edit_date"]').val('').trigger('change');
                $('[name="schedule_date"]').val('').trigger('change');
                $('[name="start_time"]').val('').trigger('change');
                $('[name="coach_id"]').val('').trigger('change');
                $('[name="status"]').val(1).trigger('change');
                $("#editScheduleForm input:hidden").val('');

                $('#editScheduleForm').trigger('reset');
                validator1.resetForm();
            }

            // Delete
            $(document).on('click', '.delete', function (e) {
                var url = $(this).attr('data-url');

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function (data) {
                        table.draw(false);
                    }
                });
            });


            var table = $('#table').DataTable({
                lengthChange: false,
                searching: false,
                info: true,
                paging: true,
                searchHighlight: false,
                ordering: false,
                autoWidth: false,
                processing: true,
                serverSide: true,
                stateSave: false,
                deferRender: true,
                lengthMenu: [[10, 25, 50, 100, 1000], [10, 25, 50, 100, 1000]],
                pageLength: 100,
                order: [[1, 'ASC']],
                columnDefs: [
                    {orderable: false, targets: [0, 1, 2, 3, 4, 5, 6, 7]},
                    {className: 'text-center', targets: [0, 3, 4, 6, 7]},
                    {width: '30px', targets: 0},
                    {width: '60px', targets: 7}
                ],
                ajax: {
                    url: '{{ route('admin.m1.classes.schedule.index',$class) }}',
                    dataType: 'json',
                    type: 'GET',
                    data: function (d) {

                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'date'},
                    {data: 'time'},
                    {data: 'weekday'},
                    {data: 'num_seats'},
                    {data: 'coach'},
                    {data: 'status'},
                    {data: 'options'}
                ],
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({page: 'current'}).nodes();
                    var last = null;

                    api.column(1, {page: 'current'}).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="12">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });

        });
    </script>
@endsection
