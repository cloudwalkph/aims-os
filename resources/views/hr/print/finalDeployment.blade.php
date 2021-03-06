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
    <div class="col-md-12 col-sm-12">
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
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h5>
                    <b>PROJECT NAME.:</b> {{ $jo->project_name }}
                </h5>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <h5>
                    <b>AE.:</b> {{ $jo->user->profile->first_name . ' ' . $jo->user->profile->last_name }}
                </h5>
            </div>
        </div>
        {{--jo number and date end--}}

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6" style="border-right: 1px  solid #ddd;">
              <h4 class="text-center">Briefing Schedule</h4>
              @if(isset($data['briefing']))
                @foreach($data['briefing'] as $key=>$briefing)
                <div class="row">
                  <h5>TEAM : {{$key}}</h5>
                </div>
                <div class="row">
                  @foreach($briefing as $manpowerSched)
                    <table class="table table-striped">
                      <caption>DATE : {{$manpowerSched['created_datetime']}}</caption>
                      <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Manpower Type</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($manpowerSched['manpower_list'] as $manpowerList)
                        <tr>
                            <td>
                              {{$manpowerList['manpower']['first_name'] . ' ' . $manpowerList['manpower']['last_name']}}
                            </td>
                            <td>
                              @foreach($manpowerList['manpower']['manpowerAssignType'] as $types)
                                @if($types['manpower_type_id'] == $manpowerList['manpower_type_required'])
                                <span>
                                  {{$types['manpowerType']['name']}}
                                </span>
                                @endif
                              @endforeach
                            </td>
                            @if($manpowerList['buffer'] == 1)
                            <td>Buffer</td>
                            @endif
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  @endforeach
                </div>
                
                @endforeach
            @endif
            
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <h4 class="text-center">Simulation Schedule</h4>
              @if(isset($data['simulation']))
                @foreach($data['simulation'] as $key=>$simulation)
                <div class="row">
                  <h5>TEAM : {{$key}}</h5>
                </div>
                <div class="row">
                  @foreach($simulation as $manpowerSched)
                    <table class="table table-striped">
                      <caption>DATE : {{$manpowerSched['created_datetime']}}</caption>
                      <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Manpower Type</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($manpowerSched['manpower_list'] as $manpowerList)
                        <tr>
                            <td>
                              {{$manpowerList['manpower']['first_name'] . ' ' . $manpowerList['manpower']['last_name']}}
                            </td>
                            <td>
                              @foreach($manpowerList['manpower']['manpowerAssignType'] as $types)
                                @if($types['manpower_type']['id'] == $manpowerList['manpower_type_required'])
                                <span>
                                  {{$types['manpowerType']['name']}}
                                </span>
                                @endif
                              @endforeach
                            </td>
                            @if($manpowerList['buffer'] == 1)
                            <td>Buffer</td>
                            @endif
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  @endforeach
                </div>
                
                @endforeach
            @endif
            
            </div>
        </div>
    </div>
</body>
</html>
