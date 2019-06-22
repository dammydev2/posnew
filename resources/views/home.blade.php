@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	@php

    	$year = date('Y');
    	$month = date('m');

    	if($year == 2021 && $month <= 6){
    	echo "needing upgrade in a couple of months";
    }
    else if ($year == 2021 && $month > 6){
echo '<meta http-equiv="refresh" content="1;url=http://localhost:8000/" />';
}

    	@endphp


    </div>
</div>
@endsection
