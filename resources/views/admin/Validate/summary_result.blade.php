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
                        <img onClick="preEventChart(this.alt)" id="chart_pie" src="https://google-developers.appspot.com/chart/interactive/images/chart_pie.png" alt="pie">
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

@section('c3scripts')

    <script src="{{ asset('js/d3/d3.min.js') }}"></script>
    <script src="{{ asset('js/c3js-chart/c3.min.js') }}"></script>
    <script src="{{ asset('js/charts-c3.js') }}"></script>
    <script>
        var chart = c3.generate({
            bindto: '#chart1',
            data: {
                columns: [
                    ['Pre-event', 30, 20, 100, 100, 15, 50],
                ],
                type: 'line',
            },
            line: {
                zerobased: false
            },
            axis: {
                x: {
                    type: 'category',
                    categories: ['Account Executives', 'Accounting', 'Creatives', 'CMTUVA', 'Setup', 'Operations', 'HR']
                }
            }
        });
    </script>

    <script>
        var chart = c3.generate({
            bindto: '#chart2',
            data: {
                columns: [
                    ['Event Proper', 30, 100, 40, 20, 50, 15],
                ],
                type: 'line',
            },
            line: {
                zerobased: false
            },
            axis: {
                x: {
                    type: 'category',
                    categories: ['Account Executives', 'Accounting', 'Creatives', 'CMTUVA', 'Setup', 'Operations', 'HR']
                }
            }
        });
    </script>

    <script>
        var chart = c3.generate({
            bindto: '#chart3',
            data: {
                columns: [
                    ['Post-event', 50, 80, 90, 75, 99, 95,88,20,30]
                ],
                type: 'line',
            },
            line: {
                zerobased: false
            },
            axis: {
                x: {
                    type: 'category',
                    categories: ['Account Executives', 'Accounting', 'Creatives', 'CMTUVA', 'Setup', 'Operations', 'HR', 'Productions', 'Inventory',]
                }
            }
        });
    </script>
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

            if(chartType == 'pie') {
                chart = new google.visualization.PieChart(container);
            } else if(chartType == 'line') {
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


