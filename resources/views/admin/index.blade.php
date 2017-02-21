@extends('layouts.admin')

@section('content')
    <div class="row">
        <h2>Calendar here</h2>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            $('#dashboard').addClass('active');
        });
    </script>
@endsection