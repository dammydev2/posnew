@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-12" style="height: 10px;"></div>

        <div class="panel panel-primary col-lg-6">
          <div class="panel-heading">Item Kit</div>
          <div class="panel-body">

            <div class="alert alert-danger">
                Please this page edit total Items that have been entered before. If you want to add items <a href="{{ url('/add_items') }}">Click here</a>
            </div>
            
            <form method="post" action="{{ url('/editItemKit') }}">

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

                @foreach($data as $row)
                <div class="form-group">
                   <label>Item Kit name</label>
                   <input type="text" value="{{ $row->name }}" name="name" class="form-control" placeholder="e.g. can coke, peak milk tin, Dano refined">
               </div>

               <input type="hidden" name="id" value="{{ $row->id }}">

               <div class="form-group">
                   <label>Category</label>
                   <input type=text" value="{{ $row->category }}" readonly="" name="category" class="form-control" placeholder="e.g. can coke, peak milk tin, Dano refined">
            </div>

            <div class="form-group">
                <label>Weight</label>
                <input type="text" value="{{ $row->weight }}" name="weight" class="form-control" placeholder="e.g. 2kg, 90g">
            </div>

            <div class="form-group">
                <div class="alert alert-danger">
                    Please note that you are changing the total quantity here, and it may affect inventory
                </div>
                <label style="color: red;">Quantity</label>
                <input type="text" value="{{ $row->quantity }}" name="quantity" class="form-control" placeholder="e.g. 10, 20">
            </div>

            <div class="form-group">
                <label>Cost Price per unit</label>
                <input type="text" value="{{ $row->c_price }}" name="c_price" class="form-control" placeholder="e.g. 200, 1200">
            </div>

            <div class="form-group">
                <label>Selling Price per unit</label>
                <input type="text" value="{{ $row->s_price }}" name="s_price" class="form-control" placeholder="e.g. 200, 1200">
            </div>

            <input type="hidden" value="{{ $row->bar_code }}" name="bar_code">

            <div class="form-group">
                <label>supplier</label>
                <input type="text" value="{{ $row->supplier }}" readonly="" name="supplier" class="form-control" placeholder="e.g. 200, 1200">
            </div>

@endforeach 

            <input type="submit" value="Update" name="submit" class="btn btn-primary">
            

        </form>

    </div>
</div>

</div>
</div>
@endsection
