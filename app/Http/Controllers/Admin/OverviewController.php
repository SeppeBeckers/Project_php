<?php

namespace App\Http\Controllers\Admin;

use App\Reservation;
use App\RoomReservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;


class OverviewController extends Controller
{
    public function index()
    {
        $reservations = Reservation::orderBy('id')->get();
        $room_reservations = RoomReservation::with('reservation')->get();

        $result = compact('reservations', 'room_reservations');
        Json::dump($result);
        return view('admin.overview', $result);


    }
    public function create(Request $request)
    {

    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:genres,name'
        ]);

        $reservation = new Reservation();
        $reservation->reservation_id = $request->reservation_id;
        $reservation->save();
        return response()->json([
            'type' => 'success',
            'text' => "The genre <b>$reservation->reservation_id</b> has been added"
        ]);
    }


    public function show(Reservation $reservation)
    {
        return redirect('admin/overview');

    }

    public function edit(Reservation $reservation)
    {
        return redirect('admin/overview');

    }







}
