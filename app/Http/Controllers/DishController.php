<?php

namespace App\Http\Controllers;

use App\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DishController extends Controller
{
    public function show()
    {
    	$result	= Dish::all();

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

    public function getFood()
    {
    	$result = Dish::where('ctg', 'Food')->get();

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

    public function getDrink()
    {
    	$result = Dish::where('ctg', 'Drink')->get();

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
    	$result	= Dish::find($id);

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
    		'name'		=> 'required',
    		'price'		=> 'required|numeric',
    		'tags'		=> 'required',
    		'ctg'		=> 'required',
    		'status'	=> 'required',
    		'desc'		=> 'required',
    		'pict'		=> 'file|image',
    	]);

    	if ($valid->fails()) {
    		$errors = $valid->errors();

    		return response()->json([
    			'status'	=> false,
    			'message'	=> $errors,
    			'data'		=> null
    		], 400);
    	}

    	$photo	= $request->file('pict');

    	if (!empty($photo)) {
	    	$phName = $photo->getClientOriginalName();

	    	$findDp = Dish::where('pict', $phName)->count();

	    	if ($findDp > 0) {
	    		$name 	= pathinfo($phName, PATHINFO_FILENAME);
	    		$inc	= $findDp + 1;
	    		$ext 	= $photo->getClientOriginalExtension();
	    		$phName	= $name . '_' . $inc . '.' . $ext;
	    	}

    		$phPath = $photo->move('img/dish', $phName);
	    } else {
	    	$phName = 'default.png';
	    }

    	$result = Dish::create([
    		'name'		=> $request->input('name'),
    		'price'		=> $request->input('price'),
    		'tags'		=> $request->input('tags'),
    		'ctg'		=> $request->input('ctg'),
    		'status'	=> $request->input('status'),
    		'desc'		=> $request->input('desc'),
    		'pict'		=> $phName
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
        $dish = Dish::find($id);

        if (empty($dish)) {
            return response()->json([
                'status'    => false,
                'message'   => 'Oops',
                'data'      => null
            ], 404);
        }

    	$valid = Validator::make($request->all(), [
    		'name'		=> 'required',
    		'price'		=> 'required|numeric',
    		'tags'		=> 'required',
    		'ctg'		=> 'required',
    		'status'	=> 'required',
    		'desc'		=> 'required',
    		'pict'		=> 'file|image',
    	]);

    	if ($valid->fails()) {
    		$errors = $valid->errors();

    		return response()->json([
    			'status'	=> false,
    			'message'	=> $errors,
    			'data'		=> null
    		], 400);
    	}

    	$photo	= $request->file('pict');

    	if (!empty($photo)) {
	    	$phName = $photo->getClientOriginalName();

	    	$findDp = Dish::where('pict', $phName)->count();

	    	if ($findDp > 0) {
	    		$name 	= pathinfo($phName, PATHINFO_FILENAME);
	    		$inc	= $findDp + 1;
	    		$ext 	= $photo->getClientOriginalExtension();
	    		$phName	= $name . '_' . $inc . '.' . $ext;
	    	}

	    	if (!empty($dish->pict) && $phName !== $dish->pict 
	    		&& $dish->pict !== 'default.png') {
		    		unlink('img/dish/' . $dish->pict);
		    }

    		$phPath = $photo->move('img/dish', $phName);
	    } else {
	    	$phName = 'default.png';
	    }

    	$result = $dish->update([
    		'name'		=> $request->input('name'),
    		'price'		=> $request->input('price'),
    		'tags'		=> $request->input('tags'),
    		'ctg'		=> $request->input('ctg'),
    		'status'	=> $request->input('status'),
    		'desc'		=> $request->input('desc'),
    		'pict'		=> $phName
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
    	$dish = Dish::find($id);

    	if (empty($dish)) {
	    	return response()->json([
	    		'status'	=> false,
	    		'message'	=> 'Oops',
	    		'data'		=> null
	    	], 404);
    	}

        if (!empty($dish->pict) && $dish->pict !== 'default.png')
            unlink('img/dish/' . $dish->pict);

    	$result = $dish->delete($id);

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