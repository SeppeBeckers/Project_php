<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\RoomReservation;
use App\Person;
use App\Age;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation.book');
    }
    public function create()
    {
        return view('reservation.data');

        $reservation = new Reservation();
        $room_reservation= new RoomReservation();

        $person = new Person();
        //person
        $person->reservation_id = $reservation->id;

        //roomreservation
        $room_reservation->reservation_id = $reservation->id ;
        $room_reservation->start_date = $request->aankomstdatum;
        $room_reservation->end_date = $request->vertrekdatum;


    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:reservations,name'
        ]);

        $reservation = new Reservation();
        $reservation->name = $request->naam;
        $reservation->first_name = $request->voornaam;
        $reservation->email = $request->email;
        $reservation->phone_number = $request->telefoonnummer;
        $reservation->address = $request->adres;
        $reservation->place = $request->stad;
        $reservation->gender = $request->geslacht;
        $reservation->save();
        return view('reservation.summary');
    }

}
