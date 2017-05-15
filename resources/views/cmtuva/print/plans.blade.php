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
            <img src="/img/aai-logo.png" alt="aims logo" style="height: 100px"/>
        </div>

        {{--jo number and date end--}}
        <div class="row" style="padding-top: 50px">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h5>
                    <b>JOB ORDER NO.:</b> {{ $jo->job_order_no }}
                </h5>
                <h5>
                    <b>PROJECT NAME.:</b> {{ $jo->project_name }}
                </h5>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <h5>
                    <b>DATE:</b> {{ $jo->created_at->toFormattedDateString() }}
                </h5>
            </div>
        </div>
        {{--jo number and date end--}}

        <div class="row">
            <hr>
        </div>

        @if( count($animations) )
        {{--animation details start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>ANIMATION DETAILS:</b></h5>
                <table class="table table-striped table-bordered animation-details" style="font-size: 11px">
                    <thead>
                    <tr>
                        <th>Particulars</th>
                        <th>Target Activity</th>
                        <th>Target Selling</th>
                        <th>Target Flyering</th>
                        <th>Target Survey</th>
                        <th>Target Experiential</th>
                        <th>Target Sampling</th>
                        <th>Target Others</th>
                        <th>Target Duration</th>
                        <th>Areas</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($animations as $animation)
                            <tr class="text-center">
                                <td>{{ $animation->particular }}</td>
                                <td>{{ $animation->target_activity }}</td>
                                <td>{{ $animation->target_selling }}</td>
                                <td>{{ $animation->target_flyering }}</td>
                                <td>{{ $animation->target_survey }}</td>
                                <td>{{ $animation->target_experiment }}</td>
                                <td>{{ $animation->target_sampling }}</td>
                                <td>{{ $animation->target_others }}</td>
                                <td>{{ $animation->target_duration }}</td>
                                <td>{{ $animation->target_areas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--animation details end--}}
        @endif

        
        {{--selected venues start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>SELECTED VENUES:</b></h5>
                <table class="table table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>VENUE</th>
                        <th>ESTIMATED FOOT TRAFFIC</th>
                        <th>ACTUAL HITS</th>
                        <th>RATE</th>
                        <th>REMARKS</th>
                    </tr>
                    </thead>

                    <tbody>
                        @if(count($selectedVenues) == 0)
                            <tr>
                                <td colspan="5">No selected venues</td>
                            </tr>
                        @endif
                        @foreach($selectedVenues as $v)
                            <tr>
                                <td>{{ $v->venue->venue }}</td>
                                <td>{{ $v->venue->eft }}</td>
                                <td>{{ $v->venue->actual_hits }}</td>
                                <td>{{ $v->venue->rate }}</td>
                                <td>{{ $v->venue->remarks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--selected venues end--}}

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

</body>
</html>
