@extends('admin.layouts.app')

@section('title')
    Home
@endsection

@section('styles')
    @parent

    <style type="text/css">
        .small-box h3 {
            font-size: 1.5rem !important;
        }

        .highcharts-credits {
            display: none;
        }
    </style>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info mt-3">
                            <div class="inner">
                                <h3>150.000 KD</h3>

                                <p>Sales</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-cash"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success mt-3">
                            <div class="inner">
                                <h3>53</h3>

                                <p>Members</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning mt-3">
                            <div class="inner">
                                <h3>10</h3>

                                <p>Coaches</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger mt-3">
                            <div class="inner">
                                <h3>5</h3>

                                <p>Guests</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->

                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cube"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Packages Sold</span>
                                <span class="info-box-number">
                                  100 <small></small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-check"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Bookings</span>
                                <span class="info-box-number">1,000</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-drum"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Events</span>
                                <span class="info-box-number">10</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Coach Applications</span>
                                <span class="info-box-number">25</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Charts -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body pl-1 pt-0 pr-3 pb-0">
                                <figure class="highcharts-figure">
                                    <div id="monthlySalesContainer"></div>
                                </figure>
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>
                    <!-- /.Left col -->
                    <!-- Right col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body pl-1 pt-0 pr-1 pb-0">
                                <figure class="highcharts-figure">
                                    <div id="yearlySalesContainer"></div>
                                </figure>
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>
                    <!-- right col -->
                </div>
                <!-- /.row -->

                <!-- Charts -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body pl-1 pt-0 pr-1 pb-0">
                                <figure class="highcharts-figure">
                                    <div id="yearlyBookingsContainer"></div>
                                </figure>
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>
                    <!-- /.Left col -->
                    <!-- Right col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body pl-1 pt-0 pr-3 pb-0">
                                <figure class="highcharts-figure">
                                    <div id="monthlyBookingsContainer"></div>
                                </figure>
                            </div><!-- /.card-body -->
                        </div><!-- /.card -->
                    </div>
                    <!-- right col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <button type="button" id="lfm" class="btn btn-sm bg-gradient-primary mb-2">Choose File</button>
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

    <!-- highcharts Js -->
    <script src="{{ asset('themes/AdminLTE/plugins/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('themes/AdminLTE/plugins/highcharts/modules/exporting.js') }}"></script>
    <script src="{{ asset('themes/AdminLTE/plugins/highcharts/modules/data.js')  }}"></script>

    <script>
        $(document).ready(function () {
            var route_prefix = "{{ url('filemanager') }}";
            lfm('lfm', {
                prefix: route_prefix,
                type: 'image', // image or file
            }, function (items) {
                console.log(items);
            });

            Highcharts.setOptions({
                colors: ['#14A2B8', '#27A844', '#FFC106', '#DC3544']
            });

            var monthlySalesOptions = {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Monthly Sales'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Sales (KD)',
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">Total {series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} KD</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Spinning Cycle',
                    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
                }, {
                    name: 'PT',
                    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
                }, {
                    name: 'Group Class',
                    data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
                }, {
                    name: 'Events',
                    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
                }]
            };
            Highcharts.chart('monthlySalesContainer', monthlySalesOptions);

            var yearlySalesOptions = {
                chart: {
                    renderTo: 'yearlySalesContainer',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Yearly Sales'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y} KD</b>' + '<br>Percentage: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false,
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Sales',
                    data: [{
                        name: 'Spinning Cycle',
                        y: 5000
                    }, {
                        name: 'PT',
                        y: 3500,
                    }, {
                        name: 'Group Class',
                        y: 6000,
                        sliced: true,
                        selected: true
                    }, {
                        name: 'Events',
                        y: 4000,
                    }]
                }]
            };
            Highcharts.chart('yearlySalesContainer', yearlySalesOptions);

            var yearlyBookingsOptions = {
                chart: {
                    renderTo: 'yearlySalesContainer',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Yearly Bookings'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y} KD</b>' + '<br>Percentage: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false,
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Bookings',
                    data: [{
                        name: 'Spinning Cycle',
                        y: 2300,
                        sliced: true,
                        selected: true
                    }, {
                        name: 'PT',
                        y: 1500
                    }, {
                        name: 'Group Class',
                        y: 1000
                    }, {
                        name: 'Events',
                        y: 500
                    }]
                }]
            };
            Highcharts.chart('yearlyBookingsContainer', yearlyBookingsOptions);

            var monthlyBookingsOptions = {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Monthly Bookings'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Bookings (No.)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">Total {series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Spinning Cycle',
                    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                    color: "#1A88C8"
                }, {
                    name: 'PT',
                    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3],
                    color: "#FF4A2F"
                }, {
                    name: 'Group Class',
                    data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2],
                    color: "#029954"
                }, {
                    name: 'Events',
                    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1],
                    color: "#EB9102"
                }]
            };
            Highcharts.chart('monthlyBookingsContainer', monthlyBookingsOptions);
        });
    </script>
@endsection
