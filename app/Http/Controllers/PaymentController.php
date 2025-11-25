<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        return view('page.payment');
    }

    public function store(Request $request)
{
    Payment::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'service' => $request->service,
        'amount' => $request->amount,
        'transaction_id' => $request->transaction_id,
        'status' => 'pending'
    ]);

    return response()->json(['message' => 'Saved']);
}

public function list()
{
    $payments = Payment::latest()->get();
    return view('page.admin', compact('payments'));
}


public function verify(Request $request)
{
    $transaction_id = $request->transaction_id;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/" . $transaction_id . "/verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer FLWSECK_TEST-bd4cc5ea7f6daba2dd5b54501ed45f9d-X"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($response);

    if ($res->status == "success") {

        // Update database record
        Payment::where('transaction_id', $transaction_id)->update([
            'status' => 'successful'
        ]);
    }

    return response()->json($res);
}
       
     
}
