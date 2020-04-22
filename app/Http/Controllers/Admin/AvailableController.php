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
    //Bewerkpagina
    public function edit(NotAvailable $not_available, Room $room)
    {
        $result = compact('not_available', 'room');
        Json::dump($result);
        return view('admin.room.not_edit', $result);
    }

    //Opslaan bewerking
    public function update(Request $request, NotAvailable $not_available)
{
    $this->validate($request, [
        'starting_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:starting_date',
    ], [
        'starting_date.required' => 'Gelieve een begindatum in te geven',
        'end_date.required' => 'Gelieve een einddatum in te geven',
        'end_date.after_or_equal:starting_date'
    ]);
    $not_available->starting_date = $request->starting_date;
    $not_available->end_date = $request->end_date;
    $not_available->save();
    session()->flash('success', "De datums zijn bewerkt");
    return redirect("/admin/room/$not_available->room_id");
}

    //Save availability
    public function store(Request $request)
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
            $not_available->starting_date = $request->starting_date;
            $not_available->end_date = $request->end_date;
            $not_available->room_id = $request->id;
            $not_available->save();
            return response()->json([
                'type' => 'success',
                'text' => "De kamer is onbeschikbaar gesteld van: <b>$not_available->starting_date</b> tot: <b>$not_available->end_date</b>"
            ]);

    }
    //Verwijder datums
    public function destroy(NotAvailable $not_available)
    {
        $not_available->delete();
        return response()->json([
            'type' => 'success',
            'text' => "Datum is succesvol verwijderd"
        ]);
    }


}
