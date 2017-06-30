@extends('ae.jolist.details.index')

@section('job-order-content')
<div class="tab-pane" id="project-status">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-body">

                <project-status-table></project-status-table>

            </div>
        </div>
    </div>
</div>
@endsection