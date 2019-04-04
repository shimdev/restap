<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function show()
    {
    	$result	= Order::all();

    	if ($result->count() > 0) {
	    	return response()->json([
	    		'status'	=> true,
	    		'message'	=> 'Success',
	    		'data'		=> $result
	    	], 302);
	    } else {
	    	return response()->json([
	    		'status'	=> false,
	    		'message'	=> 'Oops',
	    		'data'		=> null
	    	], 404);
	    }
    }

    public function detail($id)
    {
    	$result	= Order::find($id);

    	if ($result) {
	    	return response()->json([
	    		'status'	=> true,
	    		'message'	=> 'Success',
	    		'data'		=> $result
	    	], 302);
	    } else {
	    	return response()->json([
	    		'status'	=> false,
	    		'message'	=> 'Oops',
	    		'data'		=> null
	    	], 404);
	    }
    }

    public function add(Request $request)
    {
    	$valid = Validator::make($request->all(), [
    		'customer'	=> 'required',
    		'dishes'	=> 'required',
    		'seat'		=> 'nullable',
    		'note'		=> 'nullable',
    	]);

    	if ($valid->fails()) {
    		$errors = $valid->errors();

    		return response()->json([
    			'status'	=> false,
    			'message'	=> $errors,
    			'data'		=> null
    		], 400);
    	}

    	$result = Order::create([
    		'customer'	=> $request->input('customer'),
    		'dishes'	=> $request->input('dishes'),
    		'seat'		=> $request->input('seat'),
    		'note'		=> $request->input('note'),
    	]);

    	if ($result) {
    		return response()->json([
    			'status'	=> true,
    			'message'	=> 'Success',
    			'data'		=> $result
    		], 201);
    	} else {
    		return response()->json([
    			'status'	=> false,
    			'message'	=> 'Failed',
    			'data'		=> null
    		], 400);
    	}
    }

    public function edit(Request $request, $id)
    {
        $order = Order::find($id);

        if (empty($order)) {
            return response()->json([
                'status'    => false,
                'message'   => 'Oops',
                'data'      => null
            ], 404);
        }

    	$valid = Validator::make($request->all(), [
    		'status' => 'required|numeric'
    	]);

    	if ($valid->fails()) {
    		$errors = $valid->errors();

    		return response()->json([
    			'status'	=> false,
    			'message'	=> $errors,
    			'data'		=> null
    		], 400);
    	}

    	$result = $order->update([
    		'status' => $request->input('status'),
    	]);

    	if ($result) {
    		return response()->json([
    			'status'	=> true,
    			'message'	=> 'Success',
    			'data'		=> $result
    		], 201);
    	} else {
    		return response()->json([
    			'status'	=> false,
    			'message'	=> 'Failed',
    			'data'		=> null
    		], 400);
    	}
    }

    public function delete($id)
    {
    	$order = Order::find($id);

    	if (empty($order)) {
	    	return response()->json([
	    		'status'	=> false,
	    		'message'	=> 'Oops',
	    		'data'		=> null
	    	], 404);
    	}

    	$result = $order->delete($id);

    	if ($result) {
	    	return response()->json([
	    		'status'	=> true,
	    		'message'	=> 'Deleted',
	    		'data'		=> $result
	    	], 202);
    	} else {
	    	return response()->json([
	    		'status'	=> false,
	    		'message'	=> 'Failed',
	    		'data'		=> null
	    	], 400);
    	}
    }
}
