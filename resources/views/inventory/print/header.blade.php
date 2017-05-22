{{--jo number and date end--}}
<div class="row" style="padding-top: 50px">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <h5>
            <b>JOB ORDER NUMBER:</b> {{ $iJob->jobOrder->job_order_no }}
        </h5>
        <h5>
            <b>PROJECT NAME:</b> {{ $iJob->jobOrder->project_name }}
        </h5>
        <h5>
            <b>AE:</b> {{ $iJob->jobOrder->user->profile->first_name }} {{ $iJob->jobOrder->user->profile->last_name }}
        </h5>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
        <h5>
            <b>DATE:</b> {{ $iJob->created_at->toFormattedDateString() }}
        </h5>
    </div>
</div>
{{--jo number and date end--}}
