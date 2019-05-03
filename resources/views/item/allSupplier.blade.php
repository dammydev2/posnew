@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-lg-7">
    		<div class="panel-heading">Add supplier</div>
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
                <table class="table table-bordered">
                    <tr>
                        <th>Supplier Name</th>
                        <th>Supplier Address</th>
                        <th>Phone</th>
                        <th></th>
                        <th><a href="{{ url('/add_supplier') }}">Add new supplier</a></th>
                    </tr>
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->address }}</td>
                        <td>{{ $row->phone }}</td>
                        <td> <a href="{{ url('supplier_edit/'. $row->id) }}">Edit</a> </td>
                        <td> <a href="{{ url('supplier_delete/'. $row->id) }}" class="btn btn-danger">Delete</a> </td>
                    
                    @endforeach
                    </tr>
                </table>
                {{ $data->links() }}

    		</div>
    	</div>

    </div>
</div>
@endsection
