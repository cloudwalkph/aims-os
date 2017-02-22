<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
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
                <h4>
                    <b>JOB ORDER NO.:</b> UNKC2015-_______
                </h4>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <h4>
                    <b>DATE:</b> September 25, 2016
                </h4>
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




    </div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
