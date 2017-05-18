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

      <div class="row">
        <div class="col-md-12">
          {!! $header !!}
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          {!! $content !!}
        </div>
      </div>

    </div>
  </div>
</body>
</html>
