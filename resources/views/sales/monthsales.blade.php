@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	<div style="height: 50px;"></div>
    	<div class="col-sm-3"></div>
    	<div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3><center>View monthly sales</center></h3></div>
                <div class="panel-body">
                    <table class="table table-bordered">
                     <tr>
                         <td><a href="{{ url('/datemonthview') }}" class="btn btn-primary btn-block">View by date</a></td>
                         <td><a href="{{ url('/salesmanmonth') }}" class="btn btn-primary btn-block">View by salesman</a></td>
                     </tr>
                 </table>
             </div>
         </div>
     </div>


 </div>
</div>
@endsection
