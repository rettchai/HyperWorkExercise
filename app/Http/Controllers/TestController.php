<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function test()
    {

        $token = "5|hpKFkpQuRit8KagFTFBxC9is1EPWLHu99P59ZNRp0f5cee5f";
        // $url = route('order.create');
        $url = "http://localhost:8000/api/orders/create";

        $data = '
        {
            "shipping_address": "test",
            "receipt_address": "receipt_address",
            "summary_price": 27500.00,
            "products":
            [
                {
                    "products_id": 1,
                    "products_name_th": "products_name_th",
                    "products_name_en": "products_name_en",
                    "price": 12500.00
                }
                ,
                {
                    "products_id": 2,
                    "products_name_th": "products_name_th",
                    "products_name_en": "products_name_en",
                    "price": 15000.00
                }
            ]
        }
        ';

        $response = Http::withToken($token)
        ->withOptions(["verify" => false])
        ->acceptJson()
        ->withHeaders([
                'Connection' => 'keep-alive',
                'Content-Type' => 'application/json'
                ])
        ->withBody($data, 'application/json')
        ->post($url);
        return $response->status();

    }
}
