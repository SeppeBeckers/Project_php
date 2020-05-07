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

    // New arrangement
    public function create()
    {
        $arrangement = new Arrangement();
        $price = new Price();
        $result = compact('arrangement', 'price');
        Json::dump($result);
        return view('admin.arrangement.create', $result);
    }

    // Store arrangement
    public function store(Request $request)
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

        $arrangement = new Arrangement();
        $arrangement->type = $request->naam;
        $arrangement->from_day = $request->begindag;
        $arrangement->until_day = $request->einddag;
        $arrangement->description = $request->beschrijving;
        $arrangement->save();

        //Multiple prices at same time
        $price = new Price();
        $price->amount = $request->amount1;
        $price->arrangement_id = $arrangement->id;
        $price->type_room_id = 1;
        $price->occupancy_id = 1;
        $price->save();

        $price = new Price();
        $price->amount = $request->amount2;
        $price->arrangement_id = $arrangement->id;
        $price->type_room_id = 2;
        $price->occupancy_id = 1;
        $price->save();

        $price = new Price();
        $price->amount = $request->amount3;
        $price->arrangement_id = $arrangement->id;
        $price->type_room_id = 1;
        $price->occupancy_id = 2;
        $price->save();

        $price = new Price();
        $price->amount = $request->amount4;
        $price->arrangement_id = $arrangement->id;
        $price->type_room_id = 2;
        $price->occupancy_id = 2;
        $price->save();

        session()->flash('success', "Het arrangement <b>{$arrangement->type}</b> is toegevoegd.");
        return redirect('admin/arrangement');


    }

    // Edit arrangement
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


    // Update arrangement
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
        $arrangement->from_day = $request->begindag;
        $arrangement->until_day = $request->einddag;
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

        session()->flash('success', "Het arrangement <b>{$arrangement->type}</b> is aangepast.");
        return redirect('admin/arrangement');
    }

    // Delete reservation
    public function destroy(Arrangement $arrangement)
    {
        $arrangement->delete();
        session()->flash('success', "Het arrangement <b>$arrangement->type</b> is verwijderd.");
        return redirect('admin/arrangement');
    }
}
