@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

<div class="col-lg-10">
	{{ $data->links() }}
		<table class="table table-bordered">
			@php 
			$total = 0;
			@endphp
			<tr>
				<th colspan="4"><center><h3>{{ Session::get('name') }}  sales for : {{ Session::get('date') }}</h3></center></th>
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
			@endforeach
			<tr>
				<th colspan="4" class="text-right">Total Sales: &#8358;{{ number_format($total += $total, 2) }}</th>
			</tr>
		</table>
		{{ $data->links() }}
	</div>

	</div>
</div>
@endsection
