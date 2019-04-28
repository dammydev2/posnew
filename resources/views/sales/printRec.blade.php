@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-10">

			@if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(Session::has('error_msg'))
                	<div class="alert-danger alert">
                		{{ Session::get('error_msg') }}
                	</div>
                @endif
			
			<table class="table table-bordered col-sm-10">
				<tr>
					<th colspan="5">
						<center>
						Mowa Mall and Food Market<br>
						Opposite ONTEC events center, <br>
						Madojutimi, Abiola way, ABeokuta <br>
						08034721138
					</center>
					</th>
				</tr>
				<tr>
					<td colspan="5">
						Customer Name: Various Customers <br>
						Served by: <b>{{ \Auth::user()->name }}</b>
					</td>
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
				<tr>
					<th colspan="5">

						@foreach($data2 as $row)

						Amount Tendered: <b>&#8358; {{ number_format($row->tendered, 2) }}</b><br>
						Balance: <b>&#8358; {{ number_format($row->balance, 2) }}</b>

						@endforeach
						
					</th>
				</tr>
				<tr>
					<td colspan="5">Thanks for shopping with us. If you are satisfied tell others, if not, tell us <br> Opening hours: 9:00am - 8:00pm Daily <br> Sundays: 11:00am - 6:00pm</td>
				</tr>
			</table>
		</div>

	</div>
</div>

<script type="text/javascript">
<!--
window.print();
//-->
</script>
@endsection
