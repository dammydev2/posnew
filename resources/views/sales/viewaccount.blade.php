@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-12"><h3><center>Account for {{ Session::get('date') }}</center></h3></div>
		<div class="col-sm-5">
			<table class="table table-bordered">
				<tr>
					<th colspan="4"><center><h4>Stock Table</h4></center></th>
				</tr>
				<tr>
					<th>Item</th>
					<th>Cost Price</th>
					<th>Quantity</th>
					<th>Amount</th>
				</tr>
				@php $total=0; @endphp
				@foreach($data as $row)
				<tr>
					<td> {{ $row->name }} </td>
					<td> {{ $row->c_price }} </td>
					<td> {{ $row->quantity }} </td>
					<td class="text-right"> {{ number_format($amount = $row->quantity * $row->c_price, 2) }} </td>
				</tr>
				@php $total += $amount; @endphp

				@endforeach
				<tr>
					<th colspan="4" class="text-right">Amount spent on stock : {{ number_format($total, 2) }}</th>
				</tr>
			</table>
		</div>
		<div class="col-sm-1"></div>
		<!--THIS IS THE SALES TABLE-->
		<div class="col-sm-5">
			<table class="table table-bordered">
				<tr>
					<th colspan="5"><center><h4>Sales Table</h4></center></th>
				</tr>
				<tr>
					<th>Item</th>
					<th>Selling Price</th>
					<th>Cost Price</th>
					<th>Quantity</th>
					<th>Amount</th>
				</tr>
				@php
				 $total=0; 
				 $total2=0;
				 @endphp
				@foreach($data2 as $row)
				<tr>
					<td> {{ $row->name }} </td>
					<td> {{ $row->price }} </td>
					<td class="text-right"> {{ number_format($amt = $row->qty * $row->c_price, 2) }} </td>
					<td> {{ $row->qty }} </td>
					<td class="text-right"> {{ number_format($amount = $row->qty * $row->price, 2) }} </td>
				</tr>
				@php 
				$total += $amount; 
				$total2 += $amt; 
				@endphp

				@endforeach
				<tr>
					<th colspan="3" class="text-right"> {{ number_format($total2, 2) }}</th>
					<th colspan="2" class="text-right">{{ number_format($total, 2) }}</th>
				</tr>
				<tr>
					<th colspan="5">Profit: {{ number_format($total - $total2, 2) }}</th>
				</tr>
			</table>
		</div>

	</div>
</div>
@endsection
