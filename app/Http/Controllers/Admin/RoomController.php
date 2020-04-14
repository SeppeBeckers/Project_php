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
            'maxPers.integer' => 'Maximum aantal personen moet een getal zijn'
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


}
