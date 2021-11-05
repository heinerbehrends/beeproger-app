<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response returns the newly created item as json
     */
    public function store(Request $request)
    {   
        // validate the request, title is required and unique
        // return 400 BadRequest and error messages as json
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:items,title',
        ], [
            'title.required' => 'Please enter a title',
            'title.unique' => 'The title already exists',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()->first('title'),
            ];
            return response()->json($response, 400);
        }
        // if validation succeeds create the item
        $input = $request->input();
        Item::create($input);
        return Item::latest()->first();
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {   
        if($request->hasFile('foto')) {
            if($request->file('foto')->isValid()) {
                $path = $request->file('foto')->store('images');
                $item->update(['foto' => $path]);
            }
        }
        $input = $request->input();
        $item->update($input);

        return $item; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
    }
}
