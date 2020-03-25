<?php

namespace App\Http\Controllers\Admin;

use App\Arrangement;
use App\Occupancy;
use App\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class ArrangementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrangements = Arrangement::orderBy('id')
            ->has('prices')
            ->get();
        $occupancies = Occupancy::with('prices')
            ->get();
        $prices = Price::orderBy('id')
            ->get();

        $result = compact('arrangements', 'occupancies', 'prices');
        Json::dump($result);
        return view('admin.arrangement.overview', $result);
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
     * @param  \App\Arrangement  $arrangement
     * @return \Illuminate\Http\Response
     */
    public function show(Arrangement $arrangement)
    {
        $price = Price::with('arrangement')->findOrFail($id);
        $result = compact('price');
        \Facades\App\Helpers\Json::dump($result);
        return view('admin.arrangement.edit', $result);  // Pass $result to the view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Arrangement  $arrangement
     * @return \Illuminate\Http\Response
     */
    public function edit(Arrangement $arrangement)
    {
        $result = compact('arrangement');
        Json::dump($result);
        return view('admin.arrangement.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Arrangement  $arrangement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arrangement $arrangement)
    {
        $this->validate($request,[
            'type' => 'required',
            'description' => 'required',
            '$id' => 'required'
        ]);
        $arrangement->type = $request->type;
        $arrangement->description = $request->description;

        $arrangement->save();


        session()->flash('success', 'Het arrangement is aangepast');
        return redirect('admin/arrangement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Arrangement  $arrangement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arrangement $arrangement)
    {
        //
    }



}
