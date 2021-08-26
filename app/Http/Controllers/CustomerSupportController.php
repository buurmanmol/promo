<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerSupportController extends Controller
{
    public function submit(Request $request) {
        $this->validate($request, [
            'first-name' => 'required|string',
            'last-name' => 'required|string',
            'company' =>  'required|string',
            'email' => 'required|email',
            'phone-number' => 'required|string',
            'message' => 'required',
        ]);



        return response()->json(null, 200);
    }
}
