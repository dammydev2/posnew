@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="panel panel-primary col-sm-4">
			<div class="panel-heading">View Yearly sales</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<div class="alert alert-info">Select the year of sales you want to check</div>
					<form method="post" action="{{ url('/viewdate') }}">
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div><br />
						@endif
						
						{{ csrf_field() }}

						<div class="form-group col-sm-12">
							<label>Year</label>
							<select name="date" class="form-control">
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
