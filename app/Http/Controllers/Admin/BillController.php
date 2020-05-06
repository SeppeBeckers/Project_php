<?php

namespace App\Http\Controllers\Admin;

use App\AccommodationChoice;
use App\Arrangement;
use App\Bill;
use App\Person;
use App\Price;
use App\RoomReservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\Room;
use Json;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bill = Bill::with('Reservation')->get();
        $result = compact('bill');
        Json::dump($result);
        return view('/bill');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show($reservation_id)
    {

        $room_reservation = RoomReservation::with('reservation', 'room.typeRoom.prices.accommodationChoice', 'room.typeRoom.prices.arrangement')->findOrFail($reservation_id);
        $bill = Bill::with('Reservation.people.age', 'Reservation.roomReservations.room.typeRoom.prices.accommodationChoice','Reservation.roomReservations.room.typeRoom.prices.arrangement', 'billCosts')->findOrFail($reservation_id);
        $price = Price::find($bill->reservation->roomReservations->first()->price_id);
        $arrangement  = Arrangement::find($price->arrangement_id);

        $verblijfsgetal = $price->amount;
        $aantal = 0;
        foreach($bill->reservation->people as $person){
            $aantal+= $person->number_of_persons;
        }
        $aantaldagen = (strtotime($bill->reservation->roomReservations->first()->end_date)-strtotime($bill->reservation->roomReservations->first()->starting_date))/86400;
        $eindPrijs = $this->calculateDiscount($bill->reservation->people, $verblijfsgetal);
        if ($eindPrijs == $verblijfsgetal){
            $korting = 0;
        }
        else{
            $korting = 1;
        }

        $zonderKorting = $verblijfsgetal * $aantaldagen;
        $duurtotaal = $eindPrijs * $aantaldagen;
        $totaal = $duurtotaal * $aantal;
        $voorschot =  $totaal * 0.1;

        $result = compact('bill', 'aantal', 'room_reservation' ,'price','totaal', 'verblijfsgetal','zonderKorting', 'korting', 'arrangement', 'voorschot');
        Json::dump($result);
        return view('admin.bill.consult', $result);  // Pass $result to the view

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        $result = compact('bill');
        Json::dump($result);
        return view('admin.bill.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        $optel = 0;
        $price = Price::find($bill->reservation->roomReservations->first()->price_id);
        $verblijfsgetal = $price->amount;
        $eindPrijs = $this->calculateDiscount($bill->reservation->people, $verblijfsgetal);




        $aantaldagen = (strtotime($bill->reservation->roomReservations->first()->end_date)-strtotime($bill->reservation->roomReservations->first()->starting_date))/86400;
        $aantal = 0;
        foreach($bill->reservation->people as $person){
            $aantal+= $person->number_of_persons;
        }
        $duurtotaal = $eindPrijs * $aantaldagen;
        $totaal = $duurtotaal * $aantal;
        $bill->billCosts->first()->amount = $eindPrijs * $aantaldagen;
        if(($request->zwembad == true) ? 1 : 0){
            $optel +=10;
        }
        if(($request->hond == true) ? 1 : 0){
            $optel +=5;
        }
        $bill->adjusted_amount = $totaal + $request->extra + $optel;

        $bill->save();
        session()->flash('success', "De reservatie is aangepast!");
        return redirect('admin/overview');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }

    //Call the function like: calculateDiscount($Bill->reservation->people, $Bill->reservation->roomReservations->first()->Room->TypeRoom->Prices->first()->price)
    public function calculateDiscount($people, $verblijfsgetal)
    {
        $totalprice = $verblijfsgetal;
        $aantal = 0;
        $percentage = 0;
        foreach($people as $person){
            $aantal+= $person->number_of_persons;

            if($person->number_of_persons !=0 and $person->Age->percentage_discount != 0){
                $percentage = $person->Age->percentage_discount ;
            }
        }
        $korting = ($verblijfsgetal / $aantal) * $percentage ;
        $totalprice -=  $korting  ;
        return $totalprice;
    }



}
