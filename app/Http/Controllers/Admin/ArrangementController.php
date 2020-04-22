<?php

namespace App\Http\Controllers\Admin;

use App\Arrangement;
use App\Occupancy;
use App\Price;
use App\TypeRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class ArrangementController extends Controller
{
    /**
     * Door Babette Geerkens R0251746
     *
     */
    public function index()
    {
        $arrangements = Arrangement::with('prices.typeRoom', 'prices.occupancy')
            ->orderBy('id')
            ->get();

        $occupancies = Occupancy::get();
        $type_rooms = TypeRoom::get();

        $result = compact('arrangements', 'occupancies', 'type_rooms');
        //dd($result);
        Json::dump($result);
        return view('admin.arrangement.overview', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Arrangement  $arrangement
     * @return \Illuminate\Http\Response
     */
    public function edit(Arrangement $arrangement)
    {
        $arrangements = Arrangement::with('prices.typeRoom', 'prices.occupancy')
            ->orderBy('id')
            ->get();

        $occupancies = Occupancy::get();
        $type_rooms = TypeRoom::get();

        $result = compact('arrangement', 'arrangements', 'occupancies', 'type_rooms');
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
            'naam' => 'required|min:3',
            'beschrijving' => 'required|min:5',
            'amount1' => 'required',
            'amount2' => 'required',
            'amount3' => 'required',
            'amount4' => 'required',
        ], [
            'amount1.required' => 'Prijs is verplicht.',
            'amount2.required' => 'Prijs is verplicht.',
            'amount3.required' => 'Prijs is verplicht.',
            'amount4.required' => 'Prijs is verplicht.',
        ]);

        $arrangement = Arrangement::find($id);
        $arrangement->type = $request->naam;
        $arrangement->description = $request->beschrijving;
        $arrangement->save();


        //Multiple prices at same time
        $price = Price::find($request->id_1);
        $price->amount = $request->amount1;
        $price->save();

        $price = Price::find($request->id_2);
        $price->amount = $request->amount2;
        $price->save();

        $price = Price::find($request->id_3);
        $price->amount = $request->amount3;
        $price->save();

        $price = Price::find($request->id_4);
        $price->amount = $request->amount4;
        $price->save();

        session()->flash('success', 'Your price has been updated');
        return redirect('admin/arrangement');
    }


}
