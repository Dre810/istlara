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
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transaction/{$request->transaction_id}/verify/" . rawurlencode($request->transaction_id),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer FLWSECK_TEST-bd4cc5ea7f6daba2dd5b54501ed45f9d-X"
            ),
        ));

        $response = curl_exec($curl);
        

        curl_close($curl);
        $res = json_decode($response);

        return  [$res];
    }
}
