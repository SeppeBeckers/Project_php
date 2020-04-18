<?php

namespace App\Http\Controllers\Admin;

use App\NotAvailable;
use App\Room;
use App\TypeRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class RoomController extends Controller
{
    //index rooms
    public function index()
    {
        $rooms = Room::orderBy('room_number')
            ->with('typeRoom')
            ->get();
        $not_availables = NotAvailable::orderBy('starting_date')
            ->with('room')
            ->get();

        $standard_date = date("Y-m-d", strtotime('now'));

        $result = compact('rooms', 'not_availables', 'standard_date');
        Json::dump($result);
        return view('admin.room.overview', $result);
    }

    public function show($id)
    {
        $room = Room::with('typeRoom')->findOrFail($id);
        $not = NotAvailable::where('room_id',$id )->orderBy('starting_date')->get();
        $standard_date = date("Y-m-d", strtotime('now'));

        $result = compact('room', 'not',  'standard_date');

        Json::dump($result);
        return view('admin.room.not_available', $result);
    }

    //show room
    public function edit($id)
    {
        $room = Room::with('typeRoom')->findOrFail($id);
        $not = NotAvailable::where('room_id',$id )->orderBy('starting_date')->first();
        $standard_date = date("Y-m-d", strtotime('now'));
        $typeRoom = TypeRoom::orderBy('id')->get();

        $result = compact('room', 'not', 'typeRoom', 'standard_date');
        Json::dump($result);
        return view('admin.room.edit', $result);

    }

    //save room
    public function update(Request $request, Room $room)
    {
        $this->validate($request,[
            'kamerNr' => 'required|integer|min:1|unique:rooms,room_number,' . $room->id,
            'maxPers' => 'required|integer|min:1',
        ],[
            'kamerNr.required' => 'Gelieve de kamer nummer in te vullen',
            'kamerNr.integer' => 'Kamer nummer moet een getal zijn',
            'maxPers.required' => 'Gelieve de maximum aantal personen in te vullen',
            'maxPers.integer' => 'Maximum aantal personen moet een getal zijn',

        ]);

        $room->room_number = $request->kamerNr;
        $room->maximum_persons = $request->maxPers;
        $room->description = $request->beschrijving;
        $room->type_room_id = $request->faciliteiten;
        if ($request->afbeelding == null){
            $request->afbeelding = $room->picture;
        } else {
            $room->picture = $request->afbeelding;
        }
        $room->save();
        session()->flash('success', 'De kamer is succesvol verandert');
        return redirect('admin/room');
    }

    //opslaan nieuwe onbeschikbaarheid
    public function store(Request $request, NotAvailable $not_available)
    {
        $this->validate($request, [
            'starting_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:starting_date',
        ], [
            'starting_date.required' => 'Gelieve een begindatum in te geven',
            'end_date.required' => 'Gelieve een einddatum in te geven',
            'end_date.after_or_equal' => 'De einddatum mag niet voor de startdatum komen'
        ]);
        $not_available = new NotAvailable();
        $not_available->room_id = $request->id;
        $not_available->starting_date = $request->starting_date;
        $not_available->end_date = $request->end_date;
        $not_available->save();
        return response()->json([
            'type' => 'success',
            'text' => "De kamers is onbeschikbaar gesteld van: <b>$not_available->starting_date</b> tot: <b>$not_available->end_date</b>"
        ]);
    }

}
