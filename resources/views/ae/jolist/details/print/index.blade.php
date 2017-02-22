<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <style>
        .animation-details th, .animation-details td {
            vertical-align: middle !important;
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AIMS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>


    <div class="col-md-12 col-xs-12 col-sm-12">
        <div style="text-align: center">
            <img src="/images/aims-logo.png" alt="aims logo" style="height: 200px"/>
        </div>

        {{--jo number and date end--}}
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h5>
                    <b>JOB ORDER NO.:</b> UNKC2015-_______
                </h5>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <h5>
                    <b>DATE:</b> September 25, 2016
                </h5>
            </div>
        </div>
        {{--jo number and date end--}}

        {{--project type checkbox start--}}
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-6">
                <input type="checkbox" name="project_type">
                <label for="project_type">Ambient</label>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <input type="checkbox" name="project_type">
                <label for="project_type">Sampling</label>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <input type="checkbox" name="project_type">
                <label for="project_type">Selling</label>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <input type="checkbox" name="project_type">
                <label for="project_type">Tie-ups</label>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <input type="checkbox" name="project_type">
                <label for="project_type">Activations/Events</label>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6">
                <input type="checkbox" name="project_type">
                <label for="project_type">Others</label>
            </div>
        </div>
        {{--project type checkbox end--}}

        <div class="row">
            <hr>
        </div>

        {{--additional jo details start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>CLIENT:</b> Unilever Philippines - Marketing</h5>
                <h5><b>PRODUCT:</b> Various</h5>
                <h5><b>PROJECT:</b> ART Workshop</h5>
                <h5><b>ACCOUNT HANDLER:</b> Kim Chua</h5>
            </div>
        </div>
        {{--additional jo details end--}}

        {{--jo event details start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>EVENT DETAILS:</b></h5>
                <ul>
                    <li><b>What:</b> Art Workshop (Marketing Workshop)</li>
                    <li><b>When:</b> March 05-06, 2017</li>
                    <li><b>Where:</b> TBC</li>
                    <li><b>Expected Attendees:</b> 100 Attendees</li>
                </ul>
            </div>
        </div>
        {{--jo event details end--}}

        {{--jo event specification start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>EVENT SPECIFICATION:</b></h5>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab ad consequuntur
                    cupiditate deserunt dolorem eaque fugiat hic ipsum iste iure maiores minus
                    numquam possimus quae ratione reiciendis repellendus, sunt tempora.
                </p>
            </div>
        </div>
        {{--jo event specification end--}}

        {{--animation details start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>ANIMATION DETAILS:</b></h5>
                <table class="table table-striped table-bordered animation-details" style="font-size: 11px">
                    <thead>
                    <tr>
                        <th rowSpan="2">Particulars</th>
                        <th rowSpan="2">Target Activity</th>
                        <th colSpan="5">Target Hits</th>
                        <th rowSpan="2">Target Duration</th>
                        <th rowSpan="2">Areas</th>
                    </tr>

                    <tr>
                        <th> Selling </th>
                        <th> Flyering</th>
                        <th> Survey</th>
                        <th> Experiment</th>
                        <th> Other</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>Rural Area Malls</td>
                            <td>Selling + Flyering + Survey</td>
                            <td>120</td>
                            <td>120</td>
                            <td>3500</td>
                            <td>120</td>
                            <td>0</td>
                            <td>2 Days</td>
                            <td>20</td>
                        </tr>
                        <tr class="text-center">
                            <td>Rural Area Malls</td>
                            <td>Selling + Flyering + Survey</td>
                            <td>120</td>
                            <td>120</td>
                            <td>3500</td>
                            <td>120</td>
                            <td>0</td>
                            <td>2 Days</td>
                            <td>20</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{--animation details end--}}

        {{--departments involved deadlines start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>REQUIREMENTS:</b></h5>
                <table class="table table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>DEPARTMENTS</th>
                        <th>DELIVERABLES</th>
                        <th>DEADLINE</th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Creatives</td>
                            <td>To Follow</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>Operations Support</td>
                            <td>
                                1. Check possible venues for the 2-day workshop
                                <ul>
                                    <li>71 Gramercy</li>
                                    <li>Hive</li>
                                    <li>Raven</li>
                                    <li>Aracama</li>
                                </ul>
                            </td>
                            <td>February 10</td>
                        </tr>
                        <tr>
                            <td>Creatives</td>
                            <td>To Follow</td>
                            <td> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{--departments involved deadlines end--}}

        {{--project attachment start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>PROJECT ATTACHMENTS:</b></h5>
                <div class="col-md-12">
                    <input type="checkbox" name="project_attachments">
                    <label for="project_attachments">Working Cost Estimate</label>
                </div>
                <div class="col-md-12">
                    <input type="checkbox" name="project_attachments">
                    <label for="project_attachments">Working Deck</label>
                </div>
                <div class="col-md-12">
                    <input type="checkbox" name="project_attachments">
                    <label for="project_attachments">Working Checklist</label>
                </div>
            </div>
        </div>
        {{--project attachment end--}}

        {{--received by start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>RECEIVED:</b></h5>
                <div class="col-md-3 col-sm-5 col-xs-5 text-center">
                    <hr>
                    <h5><b>Operations Division</b></h5>
                </div>

            </div>
        </div>
        {{--received by end--}}

    </div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
