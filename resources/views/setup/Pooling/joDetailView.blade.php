@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
	        <input id="jobOrderId" value="{{$jo['id']}}" type="hidden"/>
	        <input id="jobOrderNumber" value="{{$jo['job_order_no']}}" type="hidden"/>
	        <input id="jobOrderTitle" value="{{$jo['project_name']}}" type="hidden"/>
	        <view-detail-jo></view-detail-jo>
	        
        </div>
    </div>
@endsection