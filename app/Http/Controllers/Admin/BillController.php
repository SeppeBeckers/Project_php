<?php

namespace App\Http\Controllers\Admin;

use App\AccommodationChoice;
use App\Arrangement;
use App\Bill;
use App\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;
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
        $Bill = Bill::with('Reservation')->get();
        $result = compact('Bill');
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




        $Bill = Bill::with('Reservation.people.age', 'Reservation.roomReservations.room.typeRoom.prices.accommodationChoice', 'billCosts')->findOrFail($reservation_id);
        $BeginPrijs = $Bill->reservation->roomReservations->first()->Room->TypeRoom->Prices->first()->price;
        $Aantal = $Bill->reservation->people->first()->number_of_persons;
        $EindPrijs = $BeginPrijs;
        foreach( $Bill->reservation->people as $Person )
            $Korting = $Person->Age->percentage_discount;
            if($Person->Age->percentage_discount != 0){
                $KortingPrijs = ($BeginPrijs / $Aantal)* $Korting ;
                $EindPrijs = $BeginPrijs - $KortingPrijs;
            }


        $result = compact('Bill', 'EindPrijs');
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
        //
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
}
