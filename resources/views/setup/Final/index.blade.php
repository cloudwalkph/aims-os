@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
	        <input id="jobOrderId" value="{{$jo['id']}}" type="hidden"/>
	        <input id="jobOrderNumber" value="{{$jo['job_order_no']}}" type="hidden"/>
	        <input id="jobOrderTitle" value="{{$jo['project_name']}}" type="hidden"/>
	        <view-final-jo></view-final-jo>
	        
        </div>
        <iframe name="finalDeploymentFrameSetup" id="finalDepFrameIdSetup" src="/setup/finalDeployment/{{$jo['job_order_no']}}" style="width:0;height:0"></iframe>
    </div>
@endsection