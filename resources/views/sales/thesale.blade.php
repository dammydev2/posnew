@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-10">
			
			<table class="table table-bordered col-sm-10">
				<tr>
					<th colspan="5">
						<center>Mowa Mall and Food Market</center>
					</th>
				</tr>
				<tr>
					@php
					$total = 0;
					$count = 1; 
					@endphp
					<th>S/N</th>
					<th>Item</th>
					<th>Qty</th>
					<th>price</th>
					<th class="text-right">Amount (&#8358;)</th>
				</tr>
				@foreach($data as $row)
				<tr>
					<th><?php echo $count++; ?></th>
					<th>{{ $row->name }}</th>
					<th>{{ $row->qty }}</th>
					<th>{{ $row->price }}</th>
					<th class="text-right">{{ number_format( $row->price * $row->qty , 2 ) }}</th>
				</tr>
				<?php $total += $row->price * $row->qty ?>
				@endforeach
				<tr>
					<th colspan="5" class="text-right">&#8358;{{ number_format($total, 2) }}</th>
				</tr>
			</table>

			<div>
				<form method="post" action="{{ url('/finish_sales') }}">
					{{ csrf_field() }}

					<div class="form-group col-sm-3">
						<label>Total Amount</label>
						<input type="text" name="amount" value="{{ $total }}" readonly="" class="form-control">
					</div>

					<div class="form-group col-sm-3">
						<label>Receipt Number</label>
						<input type="text" name="rec" value="{{ $row->rec }}" readonly="" class="form-control">
					</div>

					<div class="form-group col-sm-3">
						<label>Amount Tendered</label>
						<input type="text" name="tendered" class="form-control">
					</div>

					<div class="form-group col-sm-3">
						<label>Balance</label>
						<input type="text" name="balance" id="demo" readonly="" class="form-control">
					</div>

					<input type="hidden" name="seller" value="{{ \Auth::user()->email }}" readonly="" class="form-control">

				</form>
			</div>

			<?php $count++; ?>
		</div>

	</div>
</div>

<!--<script type="text/javascript">
<!--
window.print();
//->
</script>-->
@endsection
