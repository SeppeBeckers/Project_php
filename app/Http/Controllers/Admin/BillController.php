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

        $bill = Bill::with('Reservation.people.age', 'Reservation.roomReservations.room.typeRoom.prices.accommodationChoice', 'billCosts')->findOrFail($reservation_id);
        $eindPrijs = $this->calculateDiscount($bill->reservation->people, $bill->reservation->roomReservations->first()->Room->TypeRoom->Prices->first()->amount);
        $bill->billCosts->first()->amount = $eindPrijs;
        $result = compact('bill');
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
        $eindPrijs = $this->calculateDiscount($bill->reservation->people, $bill->reservation->roomReservations->first()->Room->TypeRoom->Prices->first()->amount);
        $bill->billCosts->first()->amount = $eindPrijs;
        if(($request->zwembad == true) ? 1 : 0){
            $optel +=10;
        }
        if(($request->hond == true) ? 1 : 0){
            $optel +=5;
        }
        $bill->adjusted_amount = $bill->billCosts->first()->amount + $request->extra + $optel;
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
    public function calculateDiscount($people, $price)
    {
        $totalprice = $price;
        foreach($people as $person){
            if($person->Age->percentage_discount!=0){
                $totalprice -= ($price / sizeof($people)) * ($person->Age->percentage_discount);
            }
        }
        return $totalprice;
    }
}
