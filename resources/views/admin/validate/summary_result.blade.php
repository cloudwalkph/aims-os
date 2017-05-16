@extends('layouts.admin')

@section('content')
    <link href="{{ asset('css/c3.css') }}" rel="stylesheet" type="text/css" style="width: 100%">

    <div class="container" style="width: 100%">
        {{--<div class="row" >--}}
            {{--<div class="col-sm-6">--}}
                {{--<button style="width: 70%;" type="button" class="btn btn-warning categorybtn">Category Details</button>--}}
            {{--</div>--}}
            {{--<div class="col-sm-6">--}}
                {{--<button style="width: 70%;" type="button" class="btn btn-warning departmentbtn">Department Details</button>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="row" >
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>PRE-EVENT
                        <img onClick="preEventChart(this.alt)" id="chart_line" src="https://google-developers.appspot.com/chart/interactive/images/chart_line.png" alt="line">
                        <img onClick="preEventChart(this.alt)" id="chart_column" src="https://google-developers.appspot.com/chart/interactive/images/chart_column.png" alt="column">
                        <img onClick="preEventChart(this.alt)" id="chart_area" src="https://google-developers.appspot.com/chart/interactive/images/chart_area.png" alt="area">
                    </th>
                </tr>
                </thead>
                <tbody id="chart1">
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th >EVENT PROPER</th>
                </tr>
                </thead>
                <tbody id="chart2">
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th >POST EVENT</th>
                </tr>
                </thead>
                <tbody id="chart3">
                </tbody>
            </table>

        </div>
    </div>
@endsection

@section('google_charts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        google.charts.load('current', {'packages':['corechart', 'line']});
        google.charts.setOnLoadCallback(preEventChart);
        google.charts.setOnLoadCallback(eventProperChart);
        google.charts.setOnLoadCallback(postEventChart);

        var preEventData = JSON.parse('<?php echo $jsonPreEvent; ?>');
        var actualEventData = JSON.parse('<?php echo $jsonActualEvent; ?>');
        var postEventData = JSON.parse('<?php echo $jsonPostEvent; ?>');

        var options = {
            animation: {
                startup: true
            },
            hAxis: {
                textStyle: {
                    fontName: 'Raleway',
                },
                title: 'Departments',
                titleTextStyle: {
                    fontName: 'Raleway',
                },
            },
            height: 500,
            legend: {
                textStyle: {
                    fontName: 'Raleway',
                }
            },
            pointSize: 5,
            title: 'Company Performance',
            titleTextStyle: {
                fontName: 'Raleway',
            },
            tooltip: {
                textStyle: {
                    fontName: 'Raleway'
                }
            },
            vAxis: {
                format: 'percent',
                gridlines: {
                    count: 11,
                },
                maxValue: 0.1,
                minValue: 0,
                textStyle: {
                    fontName: 'Raleway',
                },
                title: 'Scores',
                titleTextStyle: {
                    fontName: 'Raleway',
                },
            }
        };

        function preEventChart(chartType = 'line') {
            var jsonData = $.ajax({
                url: "",
                dataType: "json",
                async: false
            }).responseText;

            var chart;
            var container = document.getElementById('chart1');
            var data = new google.visualization.DataTable(preEventData);

            if(chartType == 'line') {
                chart = new google.visualization.LineChart(container);
            } else if(chartType == 'column') {
                chart = new google.visualization.ColumnChart(container);
            } else if(chartType == 'area') {
                chart = new google.visualization.AreaChart(container);
            }

            chart.draw(data, options);
        }

        function eventProperChart() {
            var data = new google.visualization.DataTable(actualEventData);
            var chart = new google.visualization.LineChart(document.getElementById('chart2'));

            chart.draw(data, options);
        }

        function postEventChart() {
            var data = new google.visualization.DataTable(postEventData);
            var chart = new google.visualization.LineChart(document.getElementById('chart3'));

            chart.draw(data, options);
        }
    </script>
@endsection


