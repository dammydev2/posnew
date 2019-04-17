@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	@foreach($data as $row)
    	<div class="panel panel-primary col-lg-6">
    		<div class="panel-heading">Edit category</div>
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
    			
    			<form method="post" action="{{ url('/edit_category') }}">
    				{{ csrf_field() }}
    				<input type="hidden" name="id" value="{{ $row->id }}">
    				<div class="form-group">
    					<label>Category name</label>
    					<input type="text" name="name" class="form-control" value="{{ $row->name }}">
    				</div>

                    <input type="submit" value="update" class="btn btn-primary">

    			</form>

    		</div>
    	</div>
    	@endforeach

    </div>
</div>
@endsection
