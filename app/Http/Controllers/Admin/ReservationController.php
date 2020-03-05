<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    // Edit reservation
    public function edit()
    {
        return view('admin.reservation');
    }

    // Update reservation
    public function update(Request $request)
    {
        // Validate $request
        $this->validate($request, [
            'name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
        ]);

        // Update user in the database and redirect to previous page
        $user = User::findOrFail(auth()->id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        session()->flash('success', 'Your profile has been updated');
        return back();

    }
}
