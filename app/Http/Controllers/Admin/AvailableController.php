<?php

namespace App\Http\Controllers\Admin;

use App\NotAvailable;
use App\Room;
use App\TypeRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class AvailableController extends Controller
{
    //index rooms
    public function index($id)
    {
        $room = Room::with('typeRoom')->findOrFail($id);
        $not = NotAvailable::where('room_id',$id )->orderBy('starting_date')->get();
        $standard_date = date("Y-m-d", strtotime('now'));

        $result = compact('room', 'not',  'standard_date');
        Json::dump($result);
        return view('admin.room.not_available', $result);
    }

    //Bewerk gegevens
    public function update(Request $request, NotAvailable $not_available, $id)
    {
        $this->validate($request,[
            'starting_date' => 'required',
            'end_date' => 'required'
        ],[
            'starting_date.required' => 'Gelieve de begindatum in te vullen',
            'end_date.required' => 'Gelieve de einddatum in te vullen'
        ]);
        $not_available->starting_date = $request->starting_date;
        $not_available->end_date = $request->end_date;
        $not_available->room_id = $id;
        $not_available->save();

        return response()->json([
            'type' => 'success',
            'text' => "De onbeschikbaarheid is bijgewerkt"
        ]);
    }

    //Bewaar gegevens
    public function store(Request $request, NotAvailable $not_available, $id)
    {
        $this->validate($request,[
            'starting_date' => 'required',
            'end_date' => 'required'
        ],[
            'starting_date.required' == 'Gelieve de begindatum in te vullen',
            'end_date.required' == 'Gelieve de einddatum in te vullen'
        ]);

        $not_available = new NotAvailable();
        $not_available->end_date = $request->end_date;
        $not_available->starting_date = $request->starting_date;
        $not_available->room_id = $id;
        $not_available->save();

        return response()->json([
            'type' => 'success',
            'text' => "De onbeschikbaarheid van: <b>$not_available->starting_date</b> en tot: <b>$not_available->end_date</b> is toegevoegd"
        ]);
    }

    //Verwijder gegevens
    public function destroy(NotAvailable $not_available)
    {
        $not_available->delete();
        return response()->json([
            'type' => 'success',
            'text' => "De onbeschikbaarheid is verwijdert"
        ]);
    }
}
