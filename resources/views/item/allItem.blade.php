@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-lg-10">
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
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Weight</th>
                        <th>Quantity</th>
                        <th>Cost Price</th>
                        <th>Selling Price</th>
                        <th>Bar code</th>
                        <th>Supplier</th>
                    </tr>
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->category }}</td>
                        <td>{{ $row->weight }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->c_price }}</td>
                        <td>{{ $row->s_price }}</td>
                        <td>{{ $row->bar_code }}</td>
                        <td>{{ $row->supplier }}</td>
                        <td> <a href="{{ url('item_edit/'. $row->id) }}">Edit</a> </td>
                        <td> <a href="{{ url('add_stock/'. $row->id) }}" class="btn btn-primary">Add Stock</a> </td>
                    
                    @endforeach
                    </tr>
                </table>

    		</div>
    	</div>

    </div>
</div>
@endsection
