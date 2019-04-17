@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div style="height: 20px;"></div>
    	@foreach($data as $row)
    	<div class="panel panel-primary col-lg-6">
    		<div class="panel-heading">Edit supplier</div>
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
    			
    			<form method="post" action="{{ url('/edit_supplier') }}">
    				{{ csrf_field() }}

    				<input type="hidden" name="id" value="{{ $row->id }}">

    				<div class="form-group">
    					<label>Supplier name</label>
    					<input type="text" name="name" class="form-control" value="{{ $row->name }}">
    				</div>

                    <div class="form-group">
                        <label>Supplier address</label>
                        <input type="text" name="address" class="form-control" value="{{ $row->address }}">
                    </div>

                    <div class="form-group">
                        <label>Supplier phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $row->phone }}">
                    </div>

                    <input type="submit" value="update" class="btn btn-primary">

    			</form>

    		</div>
    	</div>
    	@endforeach

    </div>
</div>
@endsection
