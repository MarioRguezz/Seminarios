<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemasApiController extends Controller
{

    public function get(Request $request) {
        $user = Auth::guard('api')->user();
    }
}
