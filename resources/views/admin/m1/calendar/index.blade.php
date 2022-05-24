@extends('admin.layouts.app')

@section('title')
    Calendar
@endsection

@section('styles')
    @parent

    <style type="text/css">
        .fc .fc-toolbar.fc-header-toolbar {
            margin-bottom: 0 !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('themes/AdminLTE/plugins/fullcalendar-scheduler/main.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">Calendar</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item">Spinning Cycle</li>
                            <li class="breadcrumb-item active">Calendar</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <div id="calendar" oncontextmenu="return false;"></div>
                            </div>
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

    <script src="{{ asset('themes/AdminLTE/plugins/fullcalendar-scheduler/main.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                themeSystem: 'bootstrap',
                initialView: 'timeGridWeek',
                customButtons: {
                    refetch: {
                        text: 'Refresh',
                        click: function () {
                            calendar.refetchEvents();
                            table.draw(false);
                        }
                    }
                },
                titleFormat: {
                    weekday: 'short',
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                },
                headerToolbar: {
                    start: 'today',
                    center: 'title',
                    end: 'refetch,prev,next'
                },
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                    week: 'Week',
                    day: 'Day',
                    list: 'List'
                },
                contentHeight: 'auto',
                allDaySlot: false,
                slotEventOverlap: false,
                slotDuration: '00:30:00',
                slotLabelInterval: {
                    minutes: 30
                },
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute: true,
                    meridiem: ''
                },
                slotMinTime: '09:00:00',
                slotMaxTime: '21:00:00',
                scrollTime: '09:00:00',
                selectable: false,
                selectMirror: false,
                unselectAuto: false,
                selectOverlap: false,
                displayEventTime: false,
                droppable: false,
                editable: false,
                eventResourceEditable: false,
                eventDurationEditable: false,
                eventOverlap: false,
                nowIndicator: true,
                refetchResourcesOnNavigate: true,
                eventConstraint: {},
                loading: function (isLoading) {
                    if (isLoading) {
                        $('.loading').show();
                    } else {
                        $('.loading').hide();
                    }
                }
            });

            calendar.render();

            // Disable text selection on right click
            $('#calendar').disableSelection();
        });
    </script>
@endsection
