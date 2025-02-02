<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\EventRegistrationController;
use Laravel\Sanctum\PersonalAccessToken;


Route::get('/user', function (Request $request) {
    $token = $request->bearerToken();
    $personalAccessToken = PersonalAccessToken::findToken($token);

    if (!$personalAccessToken) {
        return response()->json(['error' => 'Invalid token'], 401);
    }

    $user = $personalAccessToken->tokenable; // Get user from token
    return response()->json(['user' => $user]);
   
});

// Route::get('/user', function (Request $request) {
//     return response()->json($request->user());
// });

Route::post('/login', function (Request $request) {
    $user = User::where('name', $request->name)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    return response()->json(['token' => $user->createToken('Eventify')->plainTextToken]);
});

Route::post('/register', function(Request $request){

    $request->validate([
        'email'=>'required|email|unique:users,email',
        'password'=>'required|min:6',

    ]);
//crashes here
    $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)
    ]);

    return response()->json(['token' => $user->createToken('Eventify')->plainTextToken]);
//return response()->json(['as'=>'as']);
});

Route::options('/{any}', function () {
    return response()->json([], Response::HTTP_NO_CONTENT)
        ->header('Access-Control-Allow-Origin', 'http://localhost:4200')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization')
        ->header('Access-Control-Allow-Credentials', 'true');
})->where('any', '.*');

Route::post('/register-event', [EventRegistrationController::class, 'register']);
Route::get('/user-registrations/{userId}', [EventRegistrationController::class, 'getUserRegistrations']);

 