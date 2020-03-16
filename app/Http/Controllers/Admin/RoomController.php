<?php

namespace App\Http\Controllers\Admin;

use App\NotAvailable;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class RoomController extends Controller
{
    public function index()
    {
        $not_availables = NotAvailable::orderBy('room_id')->get();
        $rooms = Room::orderBy('room_number')->get();

        $result = compact('rooms', 'not_availables');
        Json::dump($result);
        return view('admin.room.overview', $result);
    }
}
