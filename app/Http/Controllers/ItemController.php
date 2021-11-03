<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

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
        $input = $request->input();
        Item::create($input);
        return Item::latest()->first(); // Or return only the status code?
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
