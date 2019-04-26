<?php

namespace App\Http\Controllers;

use App\sales;
use Illuminate\Http\Request;
use Session;
use App\Item;
use DB;

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
      'price' => $request['price'][$i],
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
