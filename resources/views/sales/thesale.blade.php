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
    			<?php $total = 0; ?>
    			<?php $count = 1; ?>
    			<th>S/N</th>
    			<th>Item</th>
    			<th>Qty</th>
    			<th>price</th>
    			<th>Amount</th>
    		</tr>
    		@foreach($data as $row)
    		<tr>
    			<th><?php echo $count++; ?></th>
    			<th>{{ $row->name }}</th>
    			<th>{{ $row->qty }}</th>
    			<th>{{ $row->price }}</th>
    			<th>{{ $row->price * $row->qty }}</th>
    		</tr>
    		<?php $total += $row->price * $row->qty ?>
    		@endforeach
    		<tr>
    			<th></th>
    		</tr>
    	</table>
    	{{ $total }}
    	<?php $count++; ?>
    	</div>

    </div>
</div>
@endsection
