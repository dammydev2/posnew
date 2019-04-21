<?php

namespace App\Http\Controllers;

use App\Item;
use Session;
use App\Category;
use App\supplier;
use App\Stock;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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

    public function ItemKit()
    {
        $data = Category::all();
        $data2 = Supplier::all();
        return view('item.itemkit', compact('data', 'data2'));
    }

    public function add_category()
    {
        return view('item.add_category');
    }

    public function add_supplier()
    {
        return view('item.add_supplier');
    }

    public function category_form(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:Categories'],
        ]);
        Category::create([
            'name' => $request['name']
        ]);

        Session::flash('success', 'Category added successfully');
        return redirect('allCategory');
    }

    public function supplier_form(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:suppliers'],
            'address' => 'required',
            'phone' => ['required', 'min:11s'],
        ]);
        supplier::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'phone' => $request['phone'],
        ]);
        Session::flash('success', 'supplier added successfully');
        return redirect('allSupplier');
    }

    public function allSupplier()
    {
        $data = supplier::paginate(20);
        return view('item.allSupplier', compact('data'));
    }

    public function allCategory()
    {
        $data = Category::all();
        return view('item.allCategory', compact('data'));
    }

    public function category_edit($id)
    {
        $data = Category::where('id', $id)->get();
        return view('item.edit_category', compact('data'));
    }

    public function edit_category(Request $request)
    {
        #dd($request->all());
        Category::where('id', $request['id'])
        ->update(['name'=>$request['name']]);
        Session::flash('success', 'Category updated successfully');
        return redirect('allCategory');
    }

    public function category_delete($id)
    {
        Category::where('id', $id)->delete();
        Session::flash('delete', 'Category deleted successfully');
        return redirect('allCategory');
    }

    public function supplier_edit($id)
    {
        $data = Supplier::where('id', $id)->get();
        return view('item.edit_supplier', compact('data'));
    }

    public function edit_supplier(Request $request)
    {
        Supplier::where('id', $request['id'])
        ->update([
            'name' => $request['name'],
            'address' => $request['address'],
            'phone' => $request['phone'],
        ]);
        Session::flash('success', 'supplier updated successfully');
        return redirect('allSupplier');
    }

    public function supplier_delete($id)
    {
        Supplier::where('id', $id)->delete();
        Session::flash('delete', 'supplier deleted successfully');
        return redirect('allSupplier');
    }

    public function addItemKit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:items'],
            'category' => 'required',
            'quantity' => 'required',
            'c_price' => 'required',
            's_price' => 'required',
        ]);

        Item::create([
            'name' => $request['name'],
            'category' => $request['category'],
            'weight' => $request['weight'],
            'quantity' => $request['quantity'],
            'c_price' => $request['c_price'],
            's_price' => $request['s_price'],
            'bar_code' => $request['bar_code'],
            'supplier' => $request['supplier'],
        ]);
        $data = Item::where('name', $request['name'])->get();
        foreach ($data as $row) {
            $item_id = $row->id;
        }

        Stock::create([
            'name' => $request['name'],
            'category' => $request['category'],
            'weight' => $request['weight'],
            'quantity' => $request['quantity'],
            'c_price' => $request['c_price'],
            's_price' => $request['s_price'],
            'bar_code' => $request['bar_code'],
            'supplier' => $request['supplier'],
            'kit_id' => $item_id,
        ]);
        Session::flash('success', 'Item added successfully');
        return redirect('allItem');
    }

    public function allItem()
    {
        $data = Item::all();
        return view('item.allItem', compact('data'));
    }

    public function item_edit($id)
    {
        $data = Item::where('id', $id)->get();
        return view('item.edit_item', compact('data'));
    }

    public function editItemKit(Request $request)
    {
        Item::where('id', $request['id'])
        ->update([
            'name' => $request['name'],
            'category' => $request['category'],
            'weight' => $request['weight'],
            'quantity' => $request['quantity'],
            'c_price' => $request['c_price'],
            's_price' => $request['s_price'],
            'bar_code' => $request['bar_code'],
            'supplier' => $request['supplier'],
        ]);
        Session::flash('success', 'Item updated successfully');
        return redirect('allItem');
    }

    public function add_stock($id)
    {
        $data2 = Supplier::all();
        $data = Item::where('id', $id)->get();
        return view('item.add_stock', compact('data', 'data2'));
    }

    public function enter_stock(Request $request)
    {
        $request->validate([
            'quantity2' => 'required',
        ]);
        Stock::create([
            'name' => $request['name'],
            'category' => $request['category'],
            'weight' => $request['weight'],
            'quantity' => $request['quantity2'],
            'c_price' => $request['c_price'],
            's_price' => $request['s_price'],
            'bar_code' => $request['bar_code'],
            'supplier' => $request['supplier'],
            'kit_id' => $request['id'],
        ]);
        $qty = $request['quantity'] + $request['quantity2'];
        Item::where('id', $request['id'])
        ->update([
            'quantity' => $qty,
            'c_price' => $request['c_price'],
            's_price' => $request['s_price'],
            'bar_code' => $request['bar_code'],
            'supplier' => $request['supplier'],
        ]);
        Session::flash('success', 'Item added successfully');
        return redirect('allItem');
    }

    public function inventory($id)
    {
        $data = Stock::where('kit_id', $id)
        ->orderBy('id', 'DESC')
        ->paginate(5);
        return view('item.inventory', compact('data'));
    }

    
}








