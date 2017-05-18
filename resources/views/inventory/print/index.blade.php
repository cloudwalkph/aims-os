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
  <div class="row">
    <div class="col-md-12">

      <div style="text-align: center">
        <img src="/img/aai-logo.png" alt="aims logo" style="height: 100px"/>
      </div>

      {{--jo number and date end--}}
      <div class="row" style="padding-top: 50px">
          <div class="col-md-6 col-sm-6 col-xs-6">
              <h5>
                  <b>JOB ORDER NO.:</b> {{ $iJob->jobOrder->job_order_no }}
              </h5>
              <h5>
                  <b>PROJECT NAME.:</b> {{ $iJob->jobOrder->project_name }}
              </h5>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6 text-right">
              <h5>
                  <b>DATE:</b> {{ $iJob->created_at->toFormattedDateString() }}
              </h5>
          </div>
      </div>
      {{--jo number and date end--}}

      <div class="row">
        <div class="col-md-12">
          {!! $content !!}
        </div>
      </div>

      <div class="row">
        <div class="col-xs-offset-9 col-xs-3 text-right">
@foreach ($iJob->assignedPerson as $assigned_person)
          <br />
          <br />
          <br />
          <div class="row" style="text-decoration: overline;">
            <div style="text-decoration: overline; text-align: center;">
              <b>{{ $assigned_person->user->profile->first_name . ' ' . $assigned_person->user->profile->last_name }}</b>
            </div>
          </div>
@endforeach
        </div>
      </div>

    </div>
  </div>
</body>
</html>
