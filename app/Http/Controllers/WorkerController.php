<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use App\User;

class WorkerController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function addworker()
	{
		return view('worker.add');
	}

	public function register2(Request $request)
	{
    	#dd($request['type']);
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
		User::create([
			'name' => $request['name'],
			'email' => $request['email'],
			'password' => Hash::make($request['password']),
			'type' => $request['type'],
		]);
		Session::flash('success', 'Worker added successfully');
		return redirect('allworkers');
	}

	public function allworkers()
	{
		$data = User::all();
		return view('worker.allworkers', compact('data'));
	}

	public function worker_edit($id)
	{
		$data = User::where('id', $id)->get();
		return view('worker.edit_worker', compact('data'));
	}

	public function edit_worker(Request $request)
	{
		$request->validate([
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'password_confirmation' => 'required',
		]);
		User::where('id', $request['id'])
		->update([
			'name' => $request['name'],
			'email' => $request['email'],
			'password' => Hash::make($request['password']),
			'type' => $request['type'],
		]);
		Session::flash('success', 'User edited successfully');
		return redirect('allworkers');
	}

	public function worker_delete($id)
    {
        User::where('id', $id)->delete();
        Session::flash('delete', 'Worker deleted successfully');
        return redirect('allworkers');
    }

}






