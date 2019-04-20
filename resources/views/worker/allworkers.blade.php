@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div class="panel panel-primary col-lg-7">
    		<div class="panel-heading">All Workers</div>
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
                        <th>category</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>
                            @php
                             if($row->type == 2)
                             {
                              echo  $type = "cashier";
                             }
                             else if($row->type == 1)
                             {
                              echo  $type = "manager";
                             }
                             else if($row->type == 0)
                             {
                              echo  $type = "admin";
                             } 
                             @endphp 
                        </td>
                        <td>{{ $row->email }}</td>
                        <td> <a href="{{ url('worker_edit/'. $row->id) }}">Edit</a> </td>
                        <td> <a href="{{ url('worker_delete/'. $row->id) }}" class="btn btn-danger">Delete</a> </td>
                    
                    @endforeach
                    </tr>
                </table>

    		</div>
    	</div>

    </div>
</div>
@endsection
