<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use App\Category;
use App\Supplier;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);
        try {
            if (! $token ) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function category_form(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Category::create([
            'name' => $request['name']
        ]);

        return response()->json(['data' =>'Category created successfully'], 201);
    }

    public function allCategory()
    {
        $data = Category::all();
        return response()->json(compact('data'), 200);
    }

    public function category_edit($id)
    {
        $data = Category::where('id', $id)->get();
        return response()->json(compact('data'), 200);
    }

    public function category_delete($id)
    {
        Category::where('id', $id)->delete();
        return response()->json(['data' =>'Category updated successfully'], 200);
    }

    public function edit_category(Request $request)
    {
        #dd($request->all());
        Category::where('id', $request['id'])
        ->update(['name' => $request['name']]);
        return response()->json(['data' =>'Category deleted successfully'], 200);
    }

    public function supplier_form(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:suppliers'],
            'address' => 'required',
            'phone' => ['required', 'min:11'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        supplier::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'phone' => $request['phone'],
        ]);
        return response()->json(['data' =>'supplier added successfully'], 200);
    }

    public function allSupplier()
    {
        $data = supplier::all();
        return response()->json(compact('data'), 200);
    }

    public function edit_supplier(Request $request)
    {
        Supplier::where('id', $request['id'])
        ->update([
            'name' => $request['name'],
            'address' => $request['address'],
            'phone' => $request['phone'],
        ]);
        return response()->json(['data' =>'supplier update successfully'], 200);
    }

}




