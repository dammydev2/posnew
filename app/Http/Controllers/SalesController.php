<?php

namespace App\Http\Controllers;

use App\sales;
use Illuminate\Http\Request;
use Session;
use App\Item;
use App\Payment;
use DB;
use App\User;
use App\Stock;

class SalesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function sale()
  {
    $data = Item::all();
    return view('sales.sale');
  }

  public function action(Request $request)
  {
   if($request->ajax())
   {
    $output = '';
    $query = $request->get('query');
    if($query != '')
    {
     $data = DB::table('items')
     ->where('bar_code', 'like', '%'.$query.'%')
     ->orWhere('name', 'like', '%'.$query.'%')
        /** ->orWhere('City', 'like', '%'.$query.'%')
         ->orWhere('PostalCode', 'like', '%'.$query.'%')
         ->orWhere('Country', 'like', '%'.$query.'%')**/
         ->orderBy('id', 'desc')
         ->get();
         
       }
       else
       {
         $data = DB::table('tbl_customer')
         ->orderBy('CustomerID', 'desc')
         ->get();
       }
       $total_row = $data->count();
       if($total_row > 0)
       {
         foreach($data as $row)
         {
          $output .= '

          <div class="col-sm-12 rst"
          data-barcode = "'.$row->bar_code.'"
          data-weight = "'.$row->weight.'"
          data-sprice = "'.$row->s_price.'"
          data-c_price = "'.$row->c_price.'"
          style="cursor:pointer;"
          >'.$row->name.'</div>';
        }
      }
      else
      {
       $output = '
       <tr>
       <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
     }
     $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
     );

     echo json_encode($data);
   }
 }

 public function sale_enter(Request $request)
 {
  $num = count($request['name']);
  //dd($num);
  for ($i=0; $i < $num; $i++) 
  { 
    Sales::create([
      'name' => $request['name'][$i],
      'bar_code' => $request['barcode'][$i],
      'qty' => $request['qty'][$i],
      'rec' => $request['rec'][$i],
      'c_price' => $request['c_price'][$i],
      'price' => $request['price'][$i],
      'seller' => \Auth::User()->email,
    ]);
  }
  Session::put('rec', $request['rec']);
  return redirect('thesale');
}

public function thesale()
{
  $rec = Session::get('rec');
  $data = Sales::where('rec', $rec)->get();
  return view('sales.thesale', compact('data'));
}

public function payment(Request $request)
{
  $request->validate([
    'tendered' => 'required',
  ]);
  if ($request['balance']=='' || $request['balance'] < 0) {
    Session::flash('error_msg', 'amount tendered is less than total cost of goods');
    return redirect('thesale');
  }
  payment::create([
    'rec' => $request['rec'],
    'amount' => $request['amount'],
    'tendered' => $request['tendered'],
    'balance' => $request['balance'],
    'seller' => $request['seller'],
  ]);
  return redirect('printRec');
}

public function printRec()
{
  $rec = Session::get('rec');
  $data = Sales::where('rec', $rec)->get();
  $data2 = Payment::where('rec', $rec)->get();
  return view('sales.printRec', compact('data', 'data2'));
}

public function daysales()
{
  return view('sales.daysales');
}

public function dateview()
{
  return view('sales.dateview');
}

public function weeksales()
{
  return view('sales.weeksales');
}

public function yearsales()
{
  return view('sales.yearsales');
}

public function viewdate(Request $request)
{
  $request->validate([
    'date' => 'required',
  ]);
  Session::put('date', $request['date']);
  return redirect('dailySales');
}

public function daterange(Request $request)
{
  $request->validate([
    'date' => 'required',
    'date2' => 'required',
  ]);
  $date = $request['date']." 00:00:00";
  $date2 = $request['date2']." 23:59:00";
  Session::put('date', $date);
  Session::put('date2', $date2);
  return redirect('rangeSales');
}

public function rangeSales()
{
  $date = Session::get('date');
  $date2 = Session::get('date2');
  $data = Sales::where('created_at', '>=', $date)
  ->where('created_at', '<=', $date2)->paginate(25);
  return view('sales.salesrange', compact('data'));
}

public function dailySales()
{
  $date = Session::get('date');
$data = Sales::where('created_at', 'like', '%'.$date.'%')->paginate(25);
  return view('sales.viewdate', compact('data'));
}

public function salesman()
{
  $data = User::where('type', 2)->get();
  return view('sales.salesman', compact('data'));
}

public function chkSaleDay(Request $request)
{
  $request->validate([
    'date' => 'required',
    'cashier' => 'required',
  ]);
  Session::put('date', $request['date']);
  Session::put('cashier', $request['cashier']);
  return redirect('dailycashier');
}

public function dailycashier()
{
  $date = Session::get('date');
  $cashier = Session::get('cashier');
  #:::::GETTING THE CASHIER NAME:::::
  $chk = User::where('email', $cashier)->get();
  foreach ($chk as $info) {
    Session::put('name', $info->name);
  }
$data = Sales::where('seller', $cashier)
->where('created_at', 'like', '%'.$date.'%')->paginate(25);
  return view('sales.viewcashier', compact('data'));
}

public function monthsales()
{
  return view('sales.monthsales');
}

public function datemonthview()
{
  return view('sales.datemonthview');
}

public function viewmonth(Request $request)
{
  $month = $request['month'];
  $year = $request['year'];
  $date = $year."-".$month;
  #:::::CHECKING DB IF DATA EXIST::::::
  $data = Sales::where('created_at', 'like', '%'.$date.'%')->get();
  if ($data->isEmpty()) {
    Session::flash('error_msg', 'no sales for the month selected');
    redirect('datemonthview');
  }
  Session::put('date', $date);
  return redirect('dailySales');
}

public function salesmanmonth()
{
  $data = User::where('type', 2)->get();
  return view('sales.salesmanmonth', compact('data'));
}

public function chkSaleMonth(Request $request)
{
  $request->validate([
    'cashier' => 'required',
  ]);
  $month = $request['month'];
  $year = $request['year'];
  $date = $year."-".$month;
  Session::put('date', $date);
  Session::put('cashier', $request['cashier']);
  return redirect('dailycashier');
}

public function account()
{
  return view('sales.selAccount');
}

public function viewmonthacc(Request $request)
{
  $month = $request['month'];
  $year = $request['year'];
  $date = $year."-".$month;
  Session::put('date', $date);
  return redirect('monthaccount');
}

public function monthaccount()
{
  $date = Session::get('date');

  $date = Session::get('date');
  #::::::GETTING THE STOCK::::::
  $data = Stock::where('created_at', 'like', '%'.$date.'%')->get();
  #::::::GETTING THE SALES::::::
  $data2 = Sales::where('created_at', 'like', '%'.$date.'%')->get();

return view('sales.viewaccount', compact('data','data2'));


  #$data = Payment::where('created_at', 'like', '%'.$date.'%')->get();
}

public function profit()
{
  $data = Stock::all();
  return view('sales.profit', compact('data'));
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(sales $sales)
    {
        //
    }
  }
