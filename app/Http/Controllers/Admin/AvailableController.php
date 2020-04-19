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

    //Verwijder datums
    public function destroy(NotAvailable $not_available)
    {
        $not_available->delete();
        return response()->json([
            'type' => 'success',
            'text' => "Datum is succesvol verwijderd"
        ]);
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




}
