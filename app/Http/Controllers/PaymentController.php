<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        return view('page.payment');
    }

    public function verify(Request $request)
    {
        return $request->transaction_id ;
    }
}
