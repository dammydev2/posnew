@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-12" style="height: 10px;"></div>

        <div class="panel panel-primary col-lg-6">
          <div class="panel-heading">Item Kit</div>
          <div class="panel-body">

            <div class="alert alert-info">
                Please this page enters fresh Items that have not been brought to the store before. If you want to add items <a href="{{ url('/add_items') }}">Click here</a>
            </div>
            
            <form method="post" action="{{ url('/addItemKit') }}">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif

                {{ csrf_field() }}
                <div class="form-group">
                   <label>Item Kit name</label>
                   <input type="text" name="name" class="form-control" placeholder="e.g. can coke, peak milk tin, Dano refined">
               </div>

               <div class="form-group">
                   <label>Category</label><a href="{{ url('/add_category') }}"> add a new category</a>
                   <select name="category" class="form-control">
                    <option>Select Category</option>
                    @foreach($data as $row)
                    <option>{{$row->name}}</option>@endforeach         
                </select>
            </div>

            <div class="form-group">
                <label>Weight</label>
                <input type="text" name="weight" class="form-control" placeholder="e.g. 2kg, 90g">
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="text" name="quantity" class="form-control" placeholder="e.g. 10, 20">
            </div>

            <div class="form-group">
                <label>Cost Price per unit</label>
                <input type="text" name="c_price" class="form-control" placeholder="e.g. 200, 1200">
            </div>

            <div class="form-group">
                <label>Selling Price per unit</label>
                <input type="text" name="s_price" class="form-control" placeholder="e.g. 200, 1200">
            </div>

            <input type="hidden" name="bar_code" value="{{ rand() }}">

            <div class="form-group">
                <label>supplier</label><a href="{{ url('/add_supplier') }}"> add a new supplier</a>
                <select name="supplier" class="form-control">
                    <option>Select supplier</option>
                    @foreach($data2 as $row)
                    <option>{{$row->name}}</option>@endforeach         
                </select>
            </div>

            <input type="submit" value="add fresh item" name="submit" class="btn btn-primary">
            

        </form>

    </div>
</div>

</div>
</div>
@endsection
