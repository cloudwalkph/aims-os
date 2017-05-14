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
    <div class="col-md-12">
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

        <div class="row">
            <div class="col-md-6">
              <h4 class="text-center">Briefing Schedule</h4>
              @if(isset($data['briefing']))
                @foreach($data['briefing'] as $key=>$briefing)
                <table class="table table-striped">
                  <caption>Team : {{$key}}</caption>
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Manpower Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($briefing as $manpowerList)
                    <tr>
                      <td>{{$manpowerList['manpower']['first_name'] . ' ' . $manpowerList['manpower']['last_name']}}</td>
                      <td>{{$manpowerList['manpower']['manpowerType']['name']}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @endforeach
            @endif
            </div><div class="col-md-6">
              <h4 class="text-center">Simulation Schedule</h4>
              @if(isset($data['simulation']))
                @foreach($data['simulation'] as $key=>$simulation)
                <table class="table table-striped">
                  <caption>Team : {{$key}}</caption>
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Manpower Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($simulation as $manpowerList)
                    
                    <tr>
                      <td>{{$manpowerList['manpower']['first_name'] . ' ' . $manpowerList['manpower']['last_name']}}</td>
                      <td>{{$manpowerList['manpower']['manpower_type']['name']}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @endforeach
            @endif
            </div>
        </div>
    </div>
</body>
</html>
