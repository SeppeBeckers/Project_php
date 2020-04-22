<?php

namespace App\Http\Controllers\Admin;

use App\AccommodationChoice;
use App\Age;
use App\Person;
use App\Reservation;
use App\Room;
use App\RoomReservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class ReservationController extends Controller
{

    /**
     * Door Babette Geerkens R0251746
     *
     */


    public function index()
    {
        return redirect('admin.reservation');
    }

    // Edit reservation
    public function edit($id)
    {
        $room_reservation = RoomReservation::with('reservation', 'room.typeRoom.prices.accommodationChoice', 'room.typeRoom.prices.occupancy', 'room.typeRoom.prices.arrangement', 'reservation.people.age')
            ->findOrFail($id);
        $ages = Age::with('persons')->get();
        $rooms = Room::all();

        $numberPersons = 0;
        foreach ($room_reservation->reservation->people as $person){
            $numberPersons += $person->number_of_persons;
        }


        $result = compact('room_reservation', 'rooms', 'ages', 'numberPersons');
        //dd($result);
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
            'age1' => 'required',
            'age2' => 'required',
            'age3' => 'required',
            'age4' => 'required',


        ], [
            'phone_number.numeric' => 'Telefoonnummer mag enkel cijfers bevatten.',
            'phone_number.required' => 'Telefoonnummer is verplicht.',
            'age1.required' => 'Leeftijd is verplicht.',
            'age2.required' => 'Leeftijd is verplicht.',
            'age3.required' => 'Leeftijd is verplicht.',
            'age4.required' => 'Leeftijd is verplicht.',
        ]);

        // Update reservation in the database and redirect to previous page
        $room_reservation = RoomReservation::find($id);
        $room_reservation->starting_date = $request->starting_date ;
        $room_reservation->end_date = $request->end_date ;
        $room_reservation->room_id = $request->room_number ;

        $room_reservation->reservation->with_deposit = $request->with_deposit ? 1 : 0;
        $room_reservation->reservation->deposit_amount = $request->deposit_amount ;
        $room_reservation->reservation->deposit_paid = $request->deposit_paid ? 1 : 0;
        $room_reservation->reservation->message = $request->message ;

        $room_reservation->reservation->name = $request->name ;
        $room_reservation->reservation->first_name = $request->first_name;
        $room_reservation->reservation->email = $request->email;

        $room_reservation->reservation->address = $request->address;
        $room_reservation->reservation->place = $request->place;
        $room_reservation->reservation->phone_number = $request->phone_number;

        $room_reservation->push();

        //aantal personen
        $person = Person::find($request->age_1);
        $person->number_of_persons = $request->age1;
        $person->save();

        $person = Person::find($request->age_2);
        $person->number_of_persons = $request->age2;
        $person->save();

        $person = Person::find($request->age_3);
        $person->number_of_persons = $request->age3;
        $person->save();

        $person = Person::find($request->age_4);
        $person->number_of_persons = $request->age4;
        if ($request->age4 == 0) {
            session()->flash('danger', "Aantal volwassen is niet aangepast, je kan deze niet de waarde 0 geven.");
            return back();
        }else {
            $person->save();
        }


        session()->flash('success', "De reservatie van <b>{$room_reservation->reservation->first_name } {$room_reservation->reservation->name }</b> is aangepast.");
        return redirect('admin/overview');

    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        session()->flash('success', "De reservatie van <b>$reservation->first_name $reservation->name</b> is verwijderd.");
        return redirect('admin/overview');
    }


}
