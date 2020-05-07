<?php

namespace App\Http\Controllers;

use App\Arrangement;
use App\NotAvailable;
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
        $ages = Age::all();
        $arrangements = Arrangement::with('prices')
            ->get();
        $accomodationchoices = AccommodationChoice::with('prices')->get();
        $typerooms = TypeRoom::with('prices')->get();
        $result = compact('arrangements', 'accomodationchoices', 'typerooms', 'ages');
        Json::dump($result);

        return view('reservation.book', $result);

    }
    public function create(Request $request)
    {
        $aantal0_3 = $request->aantal1;
        $aantal4_8 = $request->aantal2;
        $aantal9_12 = $request->aantal3;
        $aantal12 = $request->aantal4;
        $occupancies = $aantal0_3 + $aantal4_8 + $aantal9_12 + $aantal12;
        if ($occupancies >4) {
            session()->flash('danger', "Het is niet mogelijk om voor meer dan 4 personen te reserveren, gelieve 2 aparte reservaties te maken dan.");
            return back();
        }
        if ($occupancies ==0) {
            session()->flash('danger', "Gelieve een gezelschap in te geven.");
            return back();
        }

        $this->validate($request,[
            'aankomstdatum' => 'required|date|after:today',
            'vertrekdatum' => 'required|after:aankomstdatum',
            'soortkamer' => 'required',
        ]
        , [
        'aankomstdatum.after' => 'Je kan niet in het verleden boeken.',
        'vertrekdatum.after' => 'Gelieve een geldige einddatum in te geven.',
        'soortkamer.required' => 'Kies de soort kamer die je wilt.',
    ]);
            $aankomstdatum = $request->aankomstdatum;
            $vertrekdatum = $request->vertrekdatum;

            $verblijfskeuze = $request->verblijfskeuze;
            $arrangement = $request->arrangement;
            $soortkamer = $request->soortkamer;
            $comment = $request->comment;

            if ($arrangement == null) {
                $tefilterenop = 'accommodation_choice_id';
                $filter = $verblijfskeuze;
            } else {
                $tefilterenop = 'arrangement_id';
                $filter = $arrangement;
            }
            if ($arrangement and $verblijfskeuze){
                session()->flash('danger', "Het is niet mogelijk om een verblijfskeuze en een arrangement te kiezen.");
                return back();}
        if (!$arrangement and !$verblijfskeuze){
            session()->flash('danger', "Gelieve een verblijfskeuze of arrangement te kiezen.");
            return back();}
            //prijzen
            $prijzen = Price::where('type_room_id', $soortkamer)
                ->where($tefilterenop, $filter)
                ->get();
            Json::dump($prijzen);

            //kamer
            $rooms = Room::all()
                ->where('maximum_persons','>=',$occupancies)
                ->where('type_room_id',$soortkamer);

            $notavailables = NotAvailable::all();

            $gekozenkamer = TypeRoom::where('id',$soortkamer);
            $result = compact('prijzen','rooms', 'gekozenkamer','aankomstdatum', 'vertrekdatum', 'aantal0_3', 'aantal4_8', 'aantal9_12', 'aantal12', 'soortkamer','verblijfskeuze','arrangement', 'comment');
            Json::dump($result);
            return view('reservation.data', $result);

    }
    public function store(Request $request)
    {
        $request->validate([
            'soortkamer' => 'required',
            'naam' => 'required',
            'voornaam' => 'required',
            'geslacht' => 'required',
            'email' => 'required|email',
            'telefoonnummer' => 'required|min:10|numeric',
            'adres' => 'required',
            'stad' => 'required',
            'postcode' => 'required',
            'kamer'=>'required'
        ], [
            'naam.required' => 'Het veld naam is verplicht',
            'voornaam.requiered' => 'Het veld voornaam is verplicht'
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
        $reservation->with_deposit = $request->voorschot ? 1 : 0;
        $reservation->save();

        $roomreservation = new RoomReservation();
        $roomreservation->reservation_id=$reservation->id;
        $roomreservation->room_id=5;
        $roomreservation->starting_date = $request->aankomstdatum;
        $roomreservation->end_date = $request->vertrekdatum;
        $roomreservation->room_id = $request->kamer;


        $people = new Person();
        $people->reservation_id=$reservation->id;
        $people->number_of_persons=$request->aantal0_3;
        $people->age_id = 1;
        $people->save();

        $people = new Person();
        $people->reservation_id=$reservation->id;
        $people->number_of_persons=$request->aantal4_8;
        $people->age_id = 2;
        $people->save();

        $people = new Person();
        $people->reservation_id=$reservation->id;
        $people->number_of_persons=$request->aantal9_12;
        $people->age_id = 3;
        $people->save();

        $people = new Person();
        $people->reservation_id=$reservation->id;
        $people->number_of_persons=$request->aantal12;
        $people->age_id = 4;
        $people->save();

        $kamer = Room::find($request->kamer);
        $maxpersonen = $kamer->maximum_persons;
        $occupancies = $request->aantal0_3 + $request->aantal4_8 + $request->aantal9_12 + $request->aantal12;
        //false = 0, true=1
        if ($maxpersonen - $occupancies == 0){
            $sofd = 2;
        } else {
            $sofd = 1;
        }

        $arrangement = $request->arrangement;
        $verblijfskeuze = $request->verblijfskeuze;
        if ($arrangement == null) {
            $tefilterenop = 'accommodation_choice_id';
            $filter = $verblijfskeuze;
        } else {
            $tefilterenop = 'arrangement_id';
            $filter = $arrangement;
        }

        //prijs bepalen
        $prijs= Price::orderBy('id')
            ->where('type_room_id', 'like', $request->soortkamer)
            ->where('occupancy_id', 'like', $sofd)
            ->where($tefilterenop, 'like', $filter)
            ->first();

        $aantaldagen = (strtotime($request->vertrekdatum)-strtotime($request->aankomstdatum))/86400;
        $totaleprijs = ($prijs->amount *$request->aantal0_3 * 0.2 + $prijs->amount *$request->aantal4_8 *0.5 +$prijs->amount *$request->aantal9_12 *0.7  +$prijs->amount *$request->aantal12);
        if($arrangement == null) {
            $totaleprijs *= $aantaldagen;
        }
        $verblijfskeuze = AccommodationChoice::find($request->verblijfskeuze);
        $arrangement = Arrangement::find($arrangement);
        $roomreservation->price_id = $prijs->id;
        $roomreservation->save();
        $result = compact('totaleprijs','aantaldagen','kamer','prijs','arrangement','verblijfskeuze','reservation', 'roomreservation', 'occupancies');
        return view('reservation.summary', $result);
    }


}
