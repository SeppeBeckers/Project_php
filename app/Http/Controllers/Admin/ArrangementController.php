<?php

namespace App\Http\Controllers\Admin;

use App\Arrangement;
use App\Occupancy;

use App\Type_room;
use App\TypeRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class ArrangementController extends Controller
{
    public function index()
    {
        $arrangements = Arrangement::with('prices')
            ->get();
        $occupancies = Occupancy::with('prices')
            ->get();
        $type_rooms = TypeRoom::with('prices')
            ->get();
        $result = compact('arrangements', 'occupancies', 'type_rooms');
        Json::dump($result);
        return view('admin.arrangement.overview', $result);
    }

    public function edit(Arrangement $arrangement)
    {
        $result = compact('arrangement');
        Json::dump($result);
        return view('admin.arrangement.edit', $result);
    }

    public function update(Request $request, Arrangement $arrangement)
    {
        $this->validate($request,[
            'name' => 'required|min:3' . $arrangement->id
        ]);
        $arrangement->name = $request->name;
        $arrangement->save();
        session()->flash('success', 'Het arrangement is aangepast');
        return redirect('admin/arrangement/overview');
    }

    public function qryArrangements()
    {
        $arrangements = Arrangement::orderBy('name')
            ->withCount('prices')
            ->get();
        return $arrangements;
    }





}
