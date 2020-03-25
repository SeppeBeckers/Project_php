<?php

namespace App\Http\Controllers;

use App\Arrangement;
use App\Price;
use App\Reservation;
use App\Room;
use App\RoomReservation;
use App\Person;
use App\Age;
use App\AccommodationChoice;
use App\TypeRoom;
use Illuminate\Http\Request;
use Json;

class ReservationController extends Controller
{
    public function index()
    {
        $arrangements = Arrangement::with('prices')
            ->get();
        $accomodationchoices = AccommodationChoice::with('prices')->get();
        $typerooms = TypeRoom::with('prices')->get();
        $result = compact('arrangements', 'accomodationchoices', 'typerooms');
        Json::dump($result);
        return view('reservation.book', $result);

    }
    public function create(Request $request)
    {
         $reservation = new Reservation();
            $aankomstdatum = $request->aankomstdatum;
            $vertrekdatum = $request->vertrekdatum;
            $aantal0_3 = $request->aantal0_3;
            $aantal4_8 = $request->aantal4_8;
            $aantal9_12 = $request->aantal9_12;
            $aantal12 = $request->aantal12;
            $soortkamer = $request->soortkamer;
            $verblijfskeuze = $request->verblijfskeuze;
            $comment = $request->comment;
            return view('reservation.data', compact('reservation','aankomstdatum', 'vertrekdatum', 'aantal0_3', 'aantal4_8', 'aantal9_12', 'aantal12', 'soortkamer','verblijfskeuze', 'comment'));

    }
    public function store(Request $request)
    {
        $reservation = new Reservation();
        $roomreservation = new RoomReservation();
        $reservationid = $reservation->id;
        if ($request->aantal0_3 > 0) {
            $people = new Person();
            $people->reservation_id=$reservation->id;
            $people->number_of_persons=$request->aantal0_3;
            $people->age_id = 1;
            $people->save();
        }
        if ($request->aantal4_8 > 0) {
            $people = new Person();
            $people->reservation_id=$reservation->id;
            $people->number_of_persons=$request->aantal4_8;
            $people->age_id = 2;
            $people->save();
        }
        if ($request->aantal9_12 > 0) {
            $people = new Person();
            $people->reservation_id=$reservation->id;
            $people->number_of_persons=$request->aantal9_12;
            $people->age_id = 3;
            $people->save();
        }
        if ($request->aantal12 > 0) {
            $people = new Person();
            $people->reservation_id=$reservation->id;
            $people->number_of_persons=$request->aantal12;
            $people->age_id = 4;
            $people->save();
        }

        $roomreservation->reservation_id=$reservation->id;
        $roomreservation->aankomstdatum = $request->aankomstdatum;
        $roomreservation->vertrekdatum = $request->vertrektdatum;

        $occupancies = $request->aantal0_3 + $request->aantal4_8 + $request->aantal9_12 + $request->aantal12;
//        $prijs = Price::with()
//            ->where('typeroom', 'like', $request->typeroom)
//            ->where('accomodation_choice', 'like', $request->accomodationchoice->id)
//            ->orWhere('arrangement', 'like', $request->arrangement->id)
//            ->where('occupancies', 'like', $occupancies);

        $rooms = Room::with('type_rooms')->where('maximum_persons', '>=', $occupancies);
        $result = compact('rooms');
        Json::dump($result);

        $reservation->name = $request->naam;
        $reservation->first_name = $request->voornaam;
        $reservation->email = $request->email;
        $reservation->phone_number = $request->telefoonnummer;
        $reservation->address = $request->adres;
        $reservation->place = $request->stad;
        $reservation->gender = $request->geslacht;
        $reservation->message = $request->comment;
        $reservation->save();
        $roomreservation->save();
//        session()->flash('success', "Succesvol geboekt");
        return view('reservation.summary');
    }

}
