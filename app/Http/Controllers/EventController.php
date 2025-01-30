<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'date' => 'required|date',
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'email' => 'required|email',
            'verification_code' => 'required|string'
        ]);

        Event::create($request->all());

        return response()->json(['message' => 'Event Registered Successfully'], 201);

    }
    public function getRegisteredEvents(){
        return response()->json(Event::all(), 200);
    }
}
