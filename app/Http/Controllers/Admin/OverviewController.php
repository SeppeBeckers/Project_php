<?php

namespace App\Http\Controllers\Admin;

use App\Reservation;
use App\RoomReservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Calendar;
use Json;


class OverviewController extends Controller
{
    public function index()
    {
        $events = [];
        $data = RoomReservation::with('Reservation')->get();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->reservation->name,
                    true,
                    new \DateTime($value->starting_date),
                    new \DateTime($value->end_date.' +1 day'),
                    null,
                    // Add color and link on event

                    [
                        'color' => '#f05050',
                        'url' => '/admin/reservation/' . $value->id . '/edit',
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);
        return view('admin.overview', compact('calendar'));
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
            'text' => "The reservation <b>$reservation->reservation_id</b> has been added"
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
