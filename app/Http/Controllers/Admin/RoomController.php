<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('room_number')
            ->get();
        $result = compact('rooms');
        Json::dump($result);
        return view('admin.room.overview', $result);
    }
}
