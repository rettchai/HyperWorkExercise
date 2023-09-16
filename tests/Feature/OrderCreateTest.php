<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_order_create(): void
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
        // ->withOptions(["verify" => false])
        ->acceptJson()
        ->withHeaders([
                'Connection' => 'keep-alive',
                'Content-Type' => 'application/json'
                ])
        ->withBody($data, 'application/json')
        ->post($url);
        $response->status();

        // $response = $this->get('/');

        // $response->code(200);
    }
}
