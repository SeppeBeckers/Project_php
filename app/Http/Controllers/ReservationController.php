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
            $verblijfskeuze = $request->verblijfskeuze;
            $arrangement = $request->arrangement;
            $soortkamer = $request->soortkamer;
            $comment = $request->comment;
            $occupancies = $request->aantal0_3 + $request->aantal4_8 + $request->aantal9_12 + $request->aantal12;
            $samenopkamer = $request->samenopkamer;
            if ($arrangement == null) {
                $tefilterenop = 'accommodation_choice_id';
                $filter = $verblijfskeuze;
            } else {
                $tefilterenop = 'arrangement_id';
                $filter = $arrangement;
            }
            //prijzen

            $prijzen = Price::where('type_room_id', $soortkamer)
                ->where($tefilterenop, $filter)
                ->get();
            Json::dump($prijzen);

            //kamer
            if ($samenopkamer) {
                $rooms = Room::all()

                    ->where('maximum_persons','>=',$occupancies)
                    ->where('type_room_id',$soortkamer);
            } else {
                $rooms = Room::all()->where('type_room_id',$soortkamer);
            }
            json::dump($rooms);
            $gekozenkamer = TypeRoom::where('id',$soortkamer);
            $result = compact('prijzen','rooms', 'gekozenkamer','reservation','aankomstdatum', 'vertrekdatum', 'aantal0_3', 'aantal4_8', 'aantal9_12', 'aantal12', 'soortkamer','verblijfskeuze','arrangement', 'comment');
            Json::dump($result);
            return view('reservation.data', $result);

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
        $roomreservation->room_id = $request->room;
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



        $verblijfskeuze = AccommodationChoice::with('prices')->where('id','like', $request->verblijfskeuze);
        Json::dump($verblijfskeuze);
//        session()->flash('success', "Succesvol geboekt");
        return view('reservation.summary', compact('verblijfskeuze','reservation', 'roomreservation', 'occupancies'));
    }

}
