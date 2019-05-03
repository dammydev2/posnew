@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

<div class="col-lg-10">
	{{ $data->links() }}
		<table class="table table-bordered">
			@php 
			$amt = 0;
			@endphp

			@if(Session::has('date2'))
				@php $x = " - ". Session::get('date2') @endphp
			@else
				@php $x = ""  @endphp
			@endif
			<tr>
				<th colspan="4"><center><h3>Sales for : {{ Session::get('date'). $x }}</h3></center></th>
			</tr>
			<tr>
				<th>Name</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Total</th>
			</tr>
			@foreach($data as $row)
			<tr>
				<td>{{ $row->name }}</td>
				<td>{{ $row->qty }}</td>
				<td>{{ $row->price }}</td>
				<td class="text-right">{{ number_format($total = $row->price * $row->qty, 2) }}</td>
			</tr>
			@php $amt += $total; @endphp
			@endforeach
			<tr>
				<th colspan="4" class="text-right">Total Sales: &#8358;{{ number_format($amt, 2) }}</th>
			</tr>
		</table>
		{{ $data->links() }}
	</div>

	</div>
</div>
@endsection
