<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }
}
