@if(\Auth::User()->type == 0)

<li><a href="{{ url('/home') }}">Dashboard</a></li>
<li><a href="{{ url('/ItemKit') }}">Item Kit (First Supply)</a></li>
<li><a href="{{ url('/allCategory') }}">Category</a></li>
<li><a href="{{ url('/allSupplier') }}">Supplier</a></li>
<li><a href="{{ url('/allItem') }}">Item</a></li>
<li><a href="{{ url('/addworker') }}">Add worker</a></li>
<li><a href="{{ url('/allworkers') }}">Awl workers</a></li>

@elseif(\Auth::User()->type == 2)
<li><a href="{{ url('/sale') }}">Start sale</a></li>
@endif