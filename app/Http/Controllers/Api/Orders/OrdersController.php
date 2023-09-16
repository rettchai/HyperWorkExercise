<?php

namespace App\Http\Controllers\Api\Orders;

use Throwable;
use App\Models\User;
use App\Models\Orders;
use App\Models\OrdersDetail;
use Illuminate\Http\Request;
use App\Mail\OrderCreateMail;
use App\Jobs\OrderCreateQueue;
use App\Events\OrderCreateEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class OrdersController extends BaseController
{
    public function Orders(Request $request)
    {
        try {
            if(Cache::get('orders') == null) {
                $orders = Cache::remember('orders', 60, function () {
                    $order_data = Orders::query()->with(['OrdersUser', 'OrdersDetail'])->get();
                    return $this->sendResponse($order_data, 'list orders.');
                });

            }

            return Cache::get('orders');

            // $order = Orders::query()->with(['OrdersUser', 'OrdersDetail'])->paginate();
            // if($order) {

            //     return $this->sendResponse($order, 'list orders.');
            // }
        } catch (Throwable $e) {
            return $this->sendError('error', $e);
        }
    }



    public function createOrders(Request $request)
    {
        //
        try {

            $data = $request->json()->all();

            $validator = Validator::make(
                $data,
                [
                'shipping_address' => 'required',
                'receipt_address' => 'required',
                'summary_price' => 'required|numeric',
                'products' => 'required|array',
                'products.*' => 'required',
                'products.*.products_id' => 'required|integer',
                'products.*.products_name_th' => 'required|string',
                'products.*.products_name_en' => 'required|string',
                'products.*.price' => 'required|numeric',
                    ],
                [
                'shipping_address.required' => 'shipping_address required',
                'receipt_address.required' => 'receipt_address required',
                'summary_price.required' => 'summary_price required',
                'products.*.required' => 'products required',
                    ]
            );

            if($validator->fails()) {
                return $this->sendError('error', $validator->errors()->getMessages());
            } else {
                $createOrder = Orders::create(
                    [
                        'user_id' => auth()->user()->id,
                        'shipping_address' => $data['shipping_address'],
                        'receipt_address' => $data['receipt_address'],
                        'summary_price' => $data['summary_price'],
                    ]
                );
                if($createOrder) {
                    foreach($data['products'] as $product) {
                        $OrdersDetailCreate =  OrdersDetail::create(
                            [
                                'orders_id' => $createOrder->id,
                                'products_id' => $product['products_id'],
                                'products_name_th' => $product['products_name_th'],
                                'products_name_en' => $product['products_name_en'],
                                'price' => $product['price'],
                            ]
                        );
                    }

                    $order = Orders::with('OrdersUser', 'OrdersDetail', 'OrdersDetail.product_detail.product_category')->where('id', $createOrder->id)->firstOrFail();

                    // event(new OrderCreateEvent($order));
                    dispatch(new OrderCreateQueue($order));

                    return $this->sendResponse($order, 'create order successfully.');
                }
            }

        } catch (Throwable $e) {
            return $this->sendError('error', array('order' => 'create order fail.'));
        }


    }
}
