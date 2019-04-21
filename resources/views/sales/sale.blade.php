@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

<script src="{{ URL::asset('js/ajax.js') }}"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 

    	<div class="container box">
   <h3 align="center">Live search in laravel using AJAX</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading">Search Customer Data</div>
    <div class="panel-body">
     <div class="form-group">
      <input type="text" name="search" id="search" class="form-control" placeholder="Search Customer Data" />
     </div>
     <div class="table-responsive">
      <h3 align="center">Total Data : <span id="total_records"></span></h3>
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>Item Name</th>
         <th>Barcode</th>
         <th>weight</th>
         <th>Amount</th>
        </tr>
       </thead>
       <tbody>

       </tbody>
      </table>
     </div>
    </div>    
   </div>
  </div>


  <script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('live_search.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});
</script>





<script type="text/javascript">
        window.onload = function () {
            //Build an array containing Customer records.
            var customers = new Array();
            customers.push(["John Hammond", "United States"]);
            customers.push(["Mudassar Khan", "India"]);
            customers.push(["Suzanne Mathews", "France"]);
            customers.push(["Robert Schidner", "Russia"]);
 
            //Add the data rows.
            for (var i = 0; i < customers.length; i++) {
                AddRow(customers[i][0], customers[i][1]);
            }
        };
 
        function Add() {
            var txtName = document.getElementById("txtName");
            var txtCountry = document.getElementById("txtCountry");
            AddRow(txtName.value, txtCountry.value);
            txtName.value = "";
            txtCountry.value = "";
        };
 
        function Remove(button) {
            //Determine the reference of the Row using the Button.
            var row = button.parentNode.parentNode;
            var name = row.getElementsByTagName("TD")[0].innerHTML;
            if (confirm("Do you want to delete: " + name)) {
 
                //Get the reference of the Table.
                var table = document.getElementById("tblCustomers");
 
                //Delete the Table row using it's Index.
                table.deleteRow(row.rowIndex);
            }
        };
 
        function AddRow(name, country) {
            //Get the reference of the Table's TBODY element.
            var tBody = document.getElementById("tblCustomers").getElementsByTagName("TBODY")[0];
 
            //Add Row.
            row = tBody.insertRow(-1);
 
            //Add Name cell.
            var cell = row.insertCell(-1);
            cell.innerHTML = name;
 
            //Add Country cell.
            cell = row.insertCell(-1);
            cell.innerHTML = country;
 
            //Add Button cell.
            cell = row.insertCell(-1);
            var btnRemove = document.createElement("INPUT");
            btnRemove.type = "button";
            btnRemove.value = "Remove";
            btnRemove.setAttribute("onclick", "Remove(this);");
            cell.appendChild(btnRemove);
        }
    </script>
    <table id="tblCustomers" cellpadding="0" cellspacing="0" border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Country</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <td><input type="text" id="txtName" /></td>
                <td><input type="text" id="txtCountry" /></td>
                <td><input type="button" onclick="Add()" value="Add" /></td>
            </tr>
        </tfoot>
    </table>








    </div>
</div>
@endsection
