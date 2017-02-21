@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
@endsection

@section('content')
    <div class="row">

        <scheduler></scheduler>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            $('#dashboard').addClass('active');
        });
    </script>
@endsection