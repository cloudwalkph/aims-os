@extends('layouts.app')

@section('content')
    <div id="example-vertical">
        <h3> </h3>
        <section>
            <p>Try the keyboard navigation by clicking arrow left or right!</p>
        </section>
        <h3> </h3>
        <section>
            <p>Wonderful transition effects.</p>
        </section>
        <h3> </h3>
        <section>
            <p>The next and previous buttons help you to navigate through your content.</p>
        </section>
    </div>
@endsection

@section('c3scripts')
    <script>
        $("#example-vertical").steps({
            headerTag: "h3",
            bodyTag: "section",
            enableAllSteps: true,
            transitionEffect: "slideLeft",
            stepsOrientation: "vertical"
        });
    </script>
@endsection