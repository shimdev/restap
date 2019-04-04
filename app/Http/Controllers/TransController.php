<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransController extends Controller
{
    public function show()
    {
    	$result	= Transaction::all();

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
    	$result	= Transaction::find($id);

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
    		'order'		=> 'required|numeric',
    		'cashier'	=> 'required|numeric',
    		'total'		=> 'required|numeric',
    	]);

    	if ($valid->fails()) {
    		$errors = $valid->errors();

    		return response()->json([
    			'status'	=> false,
    			'message'	=> $errors,
    			'data'		=> null
    		], 400);
    	}

    	$result = Transaction::create([
    		'order'		=> $request->input('order'),
    		'cashier'	=> $request->input('cashier'),
    		'total'		=> $request->input('total'),
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
    	$trans = Transaction::find($id);

    	if (empty($trans)) {
	    	return response()->json([
	    		'status'	=> false,
	    		'message'	=> 'Oops',
	    		'data'		=> null
	    	], 404);
    	}

    	$result = $trans->delete($id);

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
