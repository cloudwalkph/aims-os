@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    	<div class="row" >
    		<input id="jobOrderNumberElement" value="{{$jobOrder}}" type="hidden"/>
    		<pooling-content data="{{$jobOrder}}"></pooling-content>
    	</div>
    </div>
@endsection