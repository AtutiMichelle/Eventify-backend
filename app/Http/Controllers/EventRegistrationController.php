<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration; 
use Illuminate\Support\Facades\Log;

class EventRegistrationController extends Controller
{
    public function register(Request $request)
    {

        $user = $request->user(); // Get the authenticated user

    Log::info('✅ Authenticated User:', ['user' => $user]);

    Log::info('📢 Incoming Request Data:', ['data' => $request->all()]);

    Log::info('✅ Authenticated User:', ['user' => $user]);
        // Validate input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|string',
            'ticket_quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'special_requests' => 'nullable|string',
        ]);

        // Generate a unique verification code
        $verificationCode = strtoupper(\Illuminate\Support\Str::random(6));

        // ✅ FIX: Use the Model Instead of Controller
        $registration = EventRegistration::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'ticket_type' => $request->ticket_type,
            'ticket_quantity' => $request->ticket_quantity,
            'payment_method' => $request->payment_method,
            'special_requests' => $request->special_requests,
            'verification_code' => $verificationCode,
        ]);

        return response()->json([
            'message' => 'Event registered successfully!',
            'verification_code' => $verificationCode
        ], 201);
    }

    public function getUserRegistrations($userId)
    {
        // ✅ FIX: Use the Model Instead of Controller
        $registrations = EventRegistration::where('user_id', $userId)
            ->with('event') 
            ->get();

        return response()->json($registrations);
    }
}
