@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-lg-11">
    		<div class="panel-heading">Inventory</div>
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
                        <th colspan="9" class="text-center">Supply Inventory</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Weight</th>
                        <th>Quantity</th>
                        <th>Cost Price</th>
                        <th>Selling Price</th>
                        <th>Bar code</th>
                        <th>Supplier</th>
                        <th>Date</th>
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
                        <td>{{ $row->created_at }}</td>
                        <td> <!--<a href="{{ url('inventory/'. $row->id) }}" class="btn btn-success">Inventory</a>--> </td>

                        @endforeach
                    </tr>
                </table>

                {{ $data->links() }}

            </div>
        </div>

    </div>
</div>
@endsection
