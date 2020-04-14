<?php

namespace App\Http\Controllers\Admin;

use App\AccommodationChoice;
use App\Reservation;
use App\Room;
use App\RoomReservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class ReservationController extends Controller
{

    public function index()
    {
        return redirect('admin.reservation');
    }

    // Edit reservation
    public function edit($id)
    {
        $room_reservation = RoomReservation::with('reservation', 'room.typeRoom.prices.accommodationChoice', 'room.typeRoom.prices.occupancy', 'room.typeRoom.prices.arrangement', 'reservation.people.age')
            ->findOrFail($id);
        $accommodations = AccommodationChoice::all();
        $rooms = Room::all();
        $result = compact('room_reservation', 'rooms', 'accommodations');
        Json::dump($result);

        return view('admin/reservation', $result);
    }

    // Update reservation
    public function update(Request $request, $id)
    {
        // Validate $request
        $this->validate($request, [
            'name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
        ], [
            'phone_number.numeric' => 'Telefoonnummer mag enkel cijfers bevatten.',
            'phone_number.required' => 'Telefoonnummer is verplicht.',
        ]);

        // Update reservation in the database and redirect to previous page
        $room_reservation = RoomReservation::find($id);
        $room_reservation->starting_date = $request->starting_date ;
        $room_reservation->end_date = $request->end_date ;
        $room_reservation->room_id = $request->room_number ;
        //$room_reservation->room->typeRoom->prices->first()->accommodationChoice->id = $request->accommodation_type ;
        //$room_reservation->room->typeRoom->prices->first()->occupancy->id = $request->occupancy ;

        $room_reservation->reservation->with_deposit = $request->with_deposit ;
        $room_reservation->reservation->deposit_amount = $request->deposit_amount ;
        //$room_reservation->reservation->deposit_paid = $request->deposit_paid ;
        $room_reservation->reservation->message = $request->message ;

        //aantal personen ....

        $room_reservation->reservation->name = $request->name ;
        $room_reservation->reservation->first_name = $request->first_name;
        $room_reservation->reservation->email = $request->email;
        $room_reservation->reservation->address = $request->address;
        $room_reservation->reservation->place = $request->place;
        $room_reservation->reservation->phone_number = $request->phone_number;

        $room_reservation->push();
        //$reservation->roomReservations->first()->room_id = (request);

        session()->flash('success', 'De reservatie is aangepast');
        return redirect('admin/overview');

    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        session()->flash('success', "De reservatie van <b>$reservation->name</b> is verwijderd!");
        return redirect('admin/overview');
    }
}
