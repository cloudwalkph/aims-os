@extends('components.jo.details')

@section('jo-details-content')
    <div class="tab-pane" id="discussions">
        <form method="POST" class="form-horizontal" style="margin-top: 20px">
            <div class="box box-info">
                <div class="box-body" style="padding: 10px 30px">
                    <discussions></discussions>
                </div>
            </div>
        </form>
    </div>
@endsection