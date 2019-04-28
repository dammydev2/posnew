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

				<form method="post" action="{{ url('/payment') }}">

					{{ csrf_field() }}

					<div class="form-group col-sm-2">
						<label>Receipt Number</label>
						<input type="text" name="rec" value="{{ $row->rec }}" readonly="" class="form-control">
					</div>

					<div class="form-group col-sm-2">
						<label>Total Amount</label>
						<input type="text" id="txt2" name="amount" value="{{ $total }}" readonly="" class="form-control">
					</div>

					<div class="form-group col-sm-2">
						<label>Amount Tendered</label>
						<input type="text" id="txt1" onkeyup="sum()" name="tendered" class="form-control">
					</div>

					<div class="form-group col-sm-2">
						<label>Balance</label>
						<input type="text" name="balance" id="txt3" readonly="" class="form-control">
					</div>

					<input type="hidden" name="seller" value="{{ \Auth::user()->email }}" readonly="" class="form-control">

					<div class="col-sm-2">
						<input type="submit" name="" value="continue" class="btn btn-primary btn-lg btn-block" style="margin-top: 15px;">
					</div>

				</form>
			</div>

			<?php $count++; ?>
		</div>

	</div>
</div>

<script type="text/javascript">
	function sum() {
       var txtFirstNumberValue = document.getElementById('txt1').value;
       var txtSecondNumberValue = document.getElementById('txt2').value;
       if (txtFirstNumberValue == "")
           txtFirstNumberValue = 0;
       if (txtSecondNumberValue == "")
           txtSecondNumberValue = 0;

       var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
       if (!isNaN(result)) {
           document.getElementById('txt3').value = result;
       }
   }
</script>

<!--<script type="text/javascript">
<!--
window.print();
//->
</script>-->
@endsection
