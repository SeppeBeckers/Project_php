<?php

namespace App\Http\Controllers;

use App\Reservation;
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
