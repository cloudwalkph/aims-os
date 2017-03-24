@extends('layouts.app')

@section('content')
    <?php
//    print_r($_GET);
//    echo array_sum($_GET['q38']);
    ?>

    <form id="formAnswers" method="get">
        {{csrf_field()}}
        <input type="hidden" name="jno" value="{{ $jno }}">
        <input type="hidden" name="deptid" value="{{ $deptid }}">
        <input type="hidden" name="ratee" value="{{ $rateeId }}">
        <input type="hidden" name="category" value="{{ $eventCategory }}">

        <div id="questionList">
            @foreach( $returnQuestions as $returnQuestion)
                <h3> </h3>
                <section>
                    <?=$returnQuestion?>
                </section>
            @endforeach
        </div>

    </form>
@endsection

@section('scripts')
    <script>
        $("#questionList").steps({
            headerTag: "h3",
            bodyTag: "section",
            enableAllSteps: true,
            transitionEffect: "slideLeft",
            stepsOrientation: "vertical",
            onFinished: function(e) {
                var formdata = $('#formAnswers').serialize();

                $.ajax({
                    url:'/questions/submitresults',
                    type: 'post',
                    data: formdata,
                    success: function () {
                        location.href = '/evaluate/{{ $jno }}/{{ $eventCategory }}';
                    }
                });
            }
        });



//        $("#questionList").steps("finish", function (){
//            alert('hello');
//        });
    </script>
@endsection