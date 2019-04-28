@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="panel panel-primary col-sm-4">
			<div class="panel-heading">View day sales</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<div class="alert alert-info">Select the name and date of sales you want to check</div>
					<form method="post" action="{{ url('/chkSaleDay') }}">
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

						<div class="form-group">
							<label>Select Cashier</label>
							<select name="cashier" class="form-control">
								<option>Select</option>
								@foreach($data as $row)
								<option value="{{ $row->email }}">{{ $row->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label>Date</label>
							<input type="date" name="date" class="form-control">
						</div>

						<input type="submit" value="check" class="btn btn-primary btn-block" name="">
					</form>
				</div>
			</div>
		</div>


	</div>
</div>
@endsection
