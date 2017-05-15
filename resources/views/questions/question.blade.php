@extends('questions.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <form id="formAnswers" method="get">
                {{csrf_field()}}
                <input type="hidden" name="jno" value="{{ $jno }}">
                <input type="hidden" name="deptid" value="{{ $deptid }}">
                <input type="hidden" name="ratee" value="{{ $rateeId }}">
                <input type="hidden" name="category" value="{{ $eventCategory }}">

                <div id="questionList">
                    <div class="row">
                        <div class="col-xs-12 text-center" style="background: #8a2adb;">
                            <h1 style="padding: 5px; font-weight: bold; color: #ffffff;">{{$jo_name}}</h1>
                            <h3 style="padding: 5px; font-weight: bold; color: #ffffff;">{{$dept_name}}</h3>
                        </div>
                    </div>
                    <div class="row" style="margin-right: 15%;">
                        <div class="col-xs-4 col-xs-offset-4 text-center">
                            <h1 style="padding: 5px;">{{$categoryName}}</h1>
                        </div>
                    </div>
                    @foreach( $returnQuestions as $returnQuestion)
                        <h3> </h3>
                        <section class="col-md-offset-4 col-md-4">
                            <?=$returnQuestion?>
                        </section>
                    @endforeach
                </div>

            </form>

            <div class="modal fade" id="questions-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Notification</h4>
                        </div>
                        <div class="modal-body">
                            Please
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="{{ URL::to('/js/bootstrap.min.js') }}"></script>
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

                    success: function ( data ) {
                        if( data == 501 ){
                            $('#questions-modal, .modal-body').text('Completely answer the questions.');
                        }else{
                            $('#questions-modal, .modal-body').text('Success');
                            setTimeout(function () {
                                location.href = '/evaluate/{{ $jno }}/{{ $eventCategory }}';
                            }, 4000);
                        }
//                        $('#questions-modal').modal('show');
                    }
                });
            }
        });
    </script>
@endsection