<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin/reservation');
    }

    public function create()
    {
        return redirect('admin.reservation');
    }

    public function store(Request $request)
    {
        return redirect('admin/reservation');
    }

    public function show(Reservation $reservation)
    {
        return redirect('admin/reservation');
    }

    // Edit reservation
    public function edit(Reservation $reservation)
    {

        $rooms = Room::orderBy('room_number');
        $result = compact('reservation', 'rooms');
        Json::dump($result);

        return view('admin/reservation', $result);
    }

    // Update reservation
    public function update(Request $request, Reservation $reservation)
    {
        // Validate $request
        $this->validate($request, [
            'name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
            'telefoonnummer' => 'required|numeric',
        ], [
            'telefoonnummer.numeric' => 'Telefoonnummer mag enkel cijfers bevatten.',
        ]);

        // Update reservation in the database and redirect to previous page
        //$reservation->reservation_made_at->timestamps();
        //$reservation->with_deposit = $request->with_deposit;
        $reservation->name = $request->name;
        $reservation->first_name = $request->first_name;
        $reservation->email = $request->email;
        $reservation->phone_number = $request->telefoonnummer;
        $reservation->address = $request->address;
        $reservation->place = $request->place;
        //$reservation->gender = $request->gender;
        $reservation->message = $request->message;
        $reservation->deposit_amount = $request->deposit_amount;
        $reservation->save();
        session()->flash('success', 'De reservatie is aangepast');
        //return back();
        return redirect('admin/overview');

    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        session()->flash('success', "De reservatie van <b>$reservation->name</b> is verwijderd!");
        return redirect('admin/overview');
    }
}
