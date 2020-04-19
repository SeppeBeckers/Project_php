<?php

namespace App\Http\Controllers\Admin;

use App\Reservation;
use App\Room;
use App\RoomReservation;
use http\Header;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Calendar;
use App\NotAvailable;
use Json;
use Symfony\Component\Mime\Header\Headers;


class OverviewController extends Controller
{
    public function index()
    {
        $events = [];
        $unavailable = [];
        $data = RoomReservation::with('Reservation', 'room', 'room.notAvailables')->get();
        $data2 = Room::with('notAvailables')->get();
        $data3 = NotAvailable::all();

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
                        'color' => '#9BC57E',
                        'url' => '/admin/reservation/' . $value->id . '/edit',
                        'title' => $value->reservation->first_name . ' ' . $value->reservation->name . ', kamer ' . $value->room->room_number ,
                        'locale' => 'nl',
                    ]


                );

            }

        }

        if($data3->count()) {
            foreach ($data3 as $key2 => $value2) {
                $unavailable[] = Calendar::event(
                    $value2->room_id,

                    true,
                    new \DateTime($value2->starting_date),
                    new \DateTime($value2->end_date.' +1 day'),
                    null,

                    // Add color and link on event

                    [
                        'color' => '#ff9f89',
                        'title' =>  'kamer '. $value2->room_id. ' niet beschikbaar' ,


                    ]


                );

            }

        }

        $calendar = Calendar::addEvents($events)->setOptions(['header'=>['left'=>'prev,next,today', 'center'=>'title', 'right'=>'month,basicWeek,basicDay']]);
        $calendar2 = Calendar::addEvents($unavailable);

        return view('admin.overview', compact('calendar2', 'calendar'));
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
