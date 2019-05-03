@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-lg-7">
    		<div class="panel-heading">Add new category</div>
    		<div class="panel-body">

                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif

                @if(Session::has('delete'))
                <div class="alert alert-danger">
                    {{ Session::get('delete') }}
                </div>
                @endif

                <a href="{{ url('/add_category') }}" class="btn btn-primary">Add new category</a>
                <table class="table table-bordered">
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td> <a href="{{ url('category_edit/'. $row->id) }}">Edit</a> </td>
                        <td> <a href="{{ url('category_delete/'. $row->id) }}" class="btn btn-danger">Delete</a> </td>
                    
                    @endforeach
                    </tr>
                </table>

    		</div>
    	</div>

    </div>
</div>
@endsection
