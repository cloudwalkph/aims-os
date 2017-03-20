@extends('layouts.app')

@section('content')
    {{--{{$id}}--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/evaluate/{{$id}}/pre">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-clipboard"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Pre-Event</label>
                            </div>
                            <div class="options">
                                <a href="/evaluate/{{$id}}/pre" class="btn btn-primary btn-lg">Evaluate</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/evaluate/{{$id}}/eprop">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-clipboard"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Event Proper</label>
                            </div>
                            <div class="options">
                                <a href="/evaluate/{{$id}}/eprop" class="btn btn-primary btn-lg">Evaluate</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/evaluate/{{$id}}/post">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-clipboard"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Post Event</label>
                            </div>
                            <div class="options">
                                <a href="/evaluate/{{$id}}/post" class="btn btn-primary btn-lg">Evaluate</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection