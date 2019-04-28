@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div style="height: 50px;"></div>
    	<div class="col-sm-3"></div>
    	<div class="col-sm-6">
    	<table class="table table-bordered">
    		<tr>
    			<td colspan="2"><center>View day sales</center></td>
    		</tr>
    		<tr>
    			<td><a href="{{ url('/dateview') }}" class="btn btn-primary btn-block">View by date</a></td>
    			<td><a href="{{ url('/salesman') }}" class="btn btn-primary btn-block">View by salesman</a></td>
    		</tr>
    	</table>
    	</div>


    </div>
</div>
@endsection
