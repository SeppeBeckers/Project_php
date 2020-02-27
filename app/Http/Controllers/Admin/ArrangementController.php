<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArrangementController extends Controller
{
    public function index()
    {
        return view('admin.arrangement.overview');
    }
}
