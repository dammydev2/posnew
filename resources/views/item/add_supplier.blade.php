@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-lg-6">
    		<div class="panel-heading">Add new Supplier</div>
    		<div class="panel-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif
    			
    			<form method="post" action="{{ url('/supplier_form') }}">
    				{{ csrf_field() }}

    				<div class="form-group">
    					<label>Supplier name</label>
    					<input type="text" name="name" class="form-control">
    				</div>

                    <div class="form-group">
                        <label>Supplier address</label>
                        <input type="text" name="address" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Supplier phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <input type="submit" name="submit" value="Add Category" class="btn btn-primary">

    			</form>

    		</div>
    	</div>

    </div>
</div>
@endsection
