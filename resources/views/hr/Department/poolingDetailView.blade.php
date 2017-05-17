@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    	<div class="row" >
    		<input id="jobOrderNumberElement" value="{{$jobOrder}}" type="hidden"/>
    		<input id="jobOrderIdNumber" value="{{$joId}}" type="hidden"/>
    		<pooling-content data="{{$jobOrder}}" joId="{{$joId}}" joEvent="{{$joEvent}}"></pooling-content>
    	</div>
    </div>

    <iframe name="finalDeploymentFrame" src="/hr/finalDeployment/{{$jobOrder}}" style="width:0;height:0"></iframe>
@endsection