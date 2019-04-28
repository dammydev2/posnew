@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="panel panel-primary col-sm-6">
			<div class="panel-heading">View Month account</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<div class="alert alert-info">Enter the date of account you want to check</div>
					<form method="post" action="{{ url('/viewmonthacc') }}">
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div><br />
						@endif

						@if(Session::has('error_msg'))
						<div class="alert alert-danger">
							{{ Session::get('error_msg') }}
						</div>
						@endif
						
						{{ csrf_field() }}

						<div class="form-group col-sm-6">
							<label>Month</label>
							<select name="month" class="form-control">
								<option>Select</option>
								<option>01</option>
								<option>02</option>
								<option>03</option>
								<option>04</option>
								<option>05</option>
								<option>06</option>
								<option>07</option>
								<option>08</option>
								<option>09</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
							</select>
						</div>

						<div class="form-group col-sm-6">
							<label>Year</label>
							<select name="year" class="form-control">
								<option>Select</option>
								@php

								$year = date('Y');
								$year2 = $year - 5;

								for($i=$year2; $i<=$year; $i++){
								echo "<option>$i</option>>";
							}

								@endphp
							</select>
						</div>

						<input type="submit" value="check" class="btn btn-primary btn-block" name="">
					</form>
				</div>
			</div>
		</div>


	</div>
</div>
@endsection
