<?php

namespace App\Http\Controllers\Api\Products;

use Throwable;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class ProductsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ProductResource::collection(Products::all());
    }

    /**
     * Show the form for creating a new resource.
     */

    public function validateData($data)
    {
        // $data = $request->json()->all();
        $validator = Validator::make(
            $data,
            [
                'name_th' => 'required|max:255',
                'name_en' => 'required|max:255',
                'price' => 'required|numeric',
                'products_categories_id' => 'required|integer',
                ]
        );

        if($validator->fails()) {
            return $this->sendError('error', $validator->errors()->getMessages());
        } else {
            return true;
        }
    }

    public function create(Request $request)
    {
        try {
            $data = $request->json()->all();
            $this->validateData($data);

            $product_create = Products::create(
                [
                    'name_th' => $data['name_th'],
                    'name_en' => $data['name_en'],
                    'price' => $data['price'],
                    'products_categories_id' => $data['products_categories_id'],
                    'active' => true,
                ]
            );
            // return $product_create;
            return $this->sendResponse($product_create, 'create product successfully.');
            // return new ProductResource($product_create);

        } catch (Throwable $e) {
            return $this->sendError('error', array('product' => 'create product fail.'));
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        try {

            if($request->user()->user_role->role_name == 'viewer') {
                return $this->sendError('error', array('product' => 'create product fail.'));
            }

            $data = $request->json()->all();
            $this->validateData($data);

            $product_update = Products::find($id);


            // return $this->sendResponse($request->user()->user_role->role_name, 'update product successfully.');
            if($request->user()->user_role->role_name == 'editor') {
                $product_update->update([
                    'name_th' => $data['name_th'],
                    'name_en' => $data['name_en'],
                    // 'price' => $data['price'],
                    'products_categories_id' => $data['products_categories_id'],
                    ]);
            }
            if($request->user()->user_role->role_name == 'admin') {
                $product_update->update($request->all());
            }


            return $this->sendResponse($product_update, 'update product successfully.');
            // return new ProductResource($product_update);

        } catch (Throwable $e) {
            return $this->sendError('error', array('product' => 'create product fail.'));
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
