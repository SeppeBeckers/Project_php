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
use App\Http\Controllers\Controller;
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
//        $this->validate($request,[
//            'aankomstdatum' => 'required'|'date'|'after:today',
//            'vertrekdatum' => 'required'|'after:aankomstdatum',
//            'soortkamer' => 'required',
//            'verblijfskeuze' => 'required',
//        ], [
//            'aankomstdatum.after' => 'Je kan niet in het verleden boeken.',
//            'vertrekdatum.after' => 'Gelieve een geldige einddatum in te geven.',
//            'soortkamer.required' => 'Kies de soort kamer die je wilt.',
//            'verblijfskeuze.required' => 'Gelieve een verblijfskeuze te kiezen.',
//        ]);

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
        $request->validate([
            'aankomstdatum' => 'required',
            'vertrekdatum' => 'required',
            'soortkamer' => 'required',
            'verblijfskeuze' => 'required',
            'verblijfskeuze' => 'required',
            'naam' => 'required',
            'voornaam' => 'required',
            'geslacht' => 'required',
            'email' => 'required',
            'telefoonnummer' => 'required',
            'adres' => 'required',
            'stad' => 'required',
            'provincie' => 'required',
            'postcode' => 'required',
        ]);
        $reservation = new Reservation();
        $reservation->name = $request->naam;
        $reservation->first_name = $request->voornaam;
        $reservation->email = $request->email;
        $reservation->phone_number = $request->telefoonnummer;
        $reservation->address = $request->adres;
        $reservation->place = $request->stad;
        $reservation->gender = $request->geslacht;
        $reservation->message = $request->comment;
        $reservation->save();

        $roomreservation = new RoomReservation();
        $roomreservation->reservation_id=$reservation->id;
        $roomreservation->room_id=5;
        $roomreservation->starting_date = $request->aankomstdatum;
        $roomreservation->end_date = $request->vertrekdatum;
        $roomreservation->save();

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

        $occupancies = $request->aantal0_3 + $request->aantal4_8 + $request->aantal9_12 + $request->aantal12;
//        $prijs = Price::with()
//            ->where('typeroom', 'like', $request->typeroom)
//            ->where('accomodation_choice', 'like', $request->accomodationchoice->id)
//            ->orWhere('arrangement', 'like', $request->arrangement->id)
//            ->where('occupancies', 'like', $occupancies);

        $rooms = Room::with('type_rooms')->where('maximum_persons', '>=', $occupancies);
        $result = compact('rooms');
        Json::dump($result);

        $verblijfskeuze = AccommodationChoice::with('prices')->where('id','like', $request->verblijfskeuze)->get();
        Json::dump($verblijfskeuze);
//        session()->flash('success', "Succesvol geboekt");
        return view('reservation.summary', compact('verblijfskeuze','reservation', 'roomreservation', 'occupancies'));
    }

}
