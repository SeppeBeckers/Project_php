<?php

namespace App\Http\Controllers\Admin;

use App\NotAvailable;
use App\Room;
use DateTime;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('room_number')->get();
        $not_availables = NotAvailable::orderBy('starting_date')->get();


        $now = new DateTime('now');
        $standard_date = date("Y-m-d", strtotime('now'));

        $result = compact('rooms', 'not_availables', 'standard_date');
        Json::dump($result);
        return view('admin.room.overview', $result);
    }
}
