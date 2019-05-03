@if(\Auth::User()->type == 0)

<li><a href="{{ url('/home') }}">Dashboard</a></li>
<li><a href="{{ url('/ItemKit') }}">Item Kit (First Supply)</a></li>
<li><a href="{{ url('/allCategory') }}">Category</a></li>
<li><a href="{{ url('/allSupplier') }}">Supplier</a></li>
<li><a href="{{ url('/allItem') }}">Item</a></li>
<li><a href="{{ url('/addworker') }}">Add worker</a></li>
<li><a href="{{ url('/allworkers') }}">All workers</a></li>
<li><a href="{{ url('/daysales') }}">Day Sales</a></li>
<li><a href="{{ url('/weeksales') }}">Date Range</a></li>
<li><a href="{{ url('/monthsales') }}">Month Sales</a></li>
<li><a href="{{ url('/yearsales') }}">Year Sales</a></li>
<li><a href="{{ url('/account') }}">account</a></li>

@elseif(\Auth::User()->type == 2)
<li><a href="{{ url('/sale') }}">Start sale</a></li>

@elseif(\Auth::User()->type == 1)

<li><a href="{{ url('/daysales') }}">Day Sales</a></li>
<li><a href="{{ url('/monthsales') }}">Month Sales</a></li>

@endif