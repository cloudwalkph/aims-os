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
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            <h5>
                <b>DATE:</b> {{ $jo->created_at->toFormattedDateString() }}
            </h5>
        </div>
    </div>
    {{--jo number and date end--}}

    {{--project type checkbox start--}}
    <div class="row">
        {{--@foreach(json_decode($jo->project_types) as $type)--}}
        <div class="col-md-4 col-sm-6 col-xs-6">
            {{--<input type="checkbox" name="project_type" checked>--}}
            <label for="project_type">{{ $jo->project_type }}</label>
        </div>
        {{--@endforeach--}}
    </div>
    {{--project type checkbox end--}}

    {{--additional jo details start--}}
    <div class="row">
        <div class="col-md-12">
            <h5><b>CLIENT:</b> {{ isset($jo->clients[0]) ? $jo->clients[0]->client->company : "No Clients" }}</h5>
            <h5><b>PRODUCT:</b> {{ collect($brands)->implode(', ') }}</h5>
            <h5><b>PROJECT:</b> {{ $jo->project_name }}</h5>
            <h5><b>ACCOUNT HANDLER:</b> {{ $jo->user->profile->first_name }} {{ $jo->user->profile->last_name }}</h5>
        </div>
    </div>
    {{--additional jo details end--}}

    @if( count($meals) )
        {{--animation details start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>MEAL REQUESTS:</b></h5>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th> Meal Type </th>
                        <th> Quantity</th>
                        <th> Serving Time</th>
                        <th> For Pick-up by</th>
                        <th> Remarks</th>
                        <th> Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($meals as $meal)
                        <tr>
                            <td>{{ $meal->mealType->name }}</td>
                            <td>{{ $meal->quantity }}</td>
                            <td>{{ $meal->serving_time }}</td>
                            <td>{{ $meal->pickup_by }}</td>
                            <td>{{ $meal->remarks }}</td>
                            <td>{{ $meal->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--animation details end--}}
    @endif

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
