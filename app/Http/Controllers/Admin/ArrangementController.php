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
        //dd($result);
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

        $arrangements = Arrangement::orderBy('id');
        $result = compact('arrangement', 'arrangements');
        Json::dump($result);
        return view('admin.arrangement.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Arrangement $arrangement
     * @param Price $price
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'naam' => 'required',
            'beschrijving' => 'required',
        ]);

        $arrangement = Arrangement::find($id);
        $arrangement->type = $request->naam;
        $arrangement->description = $request->beschrijving;
        $arrangement->save();


        //Multiple prices at same time
        $price = Price::find($request->id[0]);
        $price->amount = $request->amount[0];
        $price->save();

        $price = Price::find($request->id[1]);
        $price->amount = $request->amount[1];
        $price->save();

        $price = Price::find($request->id[2]);
        $price->amount = $request->amount[2];
        $price->save();

        $price = Price::find($request->id[3]);
        $price->amount = $request->amount[3];
        $price->save();

        session()->flash('success', 'Your price has been updated');
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

    public function qryArrangements()
    {
        $prices = Price::orderBy('id')
            ->get();
        return $prices;
    }



}
