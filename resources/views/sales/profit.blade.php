@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="panel panel-primary col-sm-10">
			<div class="panel-heading">Stock & Profit Margin</div>
			<div class="panel-body">
				<div class="col-sm-12">

					<table class="table table-bordered">
						<tr>
							<th>S/N</th>
							<th>Item</th>
							<th>Quantity at hand</th>
							<th>cost per unit</th>
							<th>Cost Price</th>
							<th>Selling per unit</th>
							<th>Selling Price</th>
							<th>Net Profit</th>
						</tr>
						<?php 
						$num=1;
						$total =0;

						 ?>

						@foreach($data as $row)
						<tr>
							<td>{{ $num++ }}</td>
							<td>{{ $row->name." (".$row->weight.")" }}</td>
							<td>{{ $row->quantity }}</td>
							<td>{{ $row->c_price }}</td>
							<td>{{ $cost = $row->c_price * $row->quantity }}</td>
							<td>{{ $row->s_price }}</td>
							<td>{{ $sell = $row->s_price * $row->quantity }}</td>
							<td class="text-right">{{ number_format($profit = $sell - $cost, 2) }}</td>
						</tr>
						@php

						$total += $profit;

						@endphp

						@endforeach
						<tr>
							<td colspan="7" class="text-right">Gross Profit</td>
							<th class="text-right">&#8358; {{ number_format($total, 2) }}</th>
						</tr>

						<?php $num++ ?>
					</table>

				</div>
			</div>
		</div>


	</div>
</div>
@endsection
