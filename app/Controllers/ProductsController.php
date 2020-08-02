<?php

namespace App\Controllers;

use App\Validators\ProductsValidator;
use CQ\Controllers\Controller;
use CQ\DB\DB;
use CQ\Helpers\UUID;
use Exception;

class ProductsController extends Controller
{
    /**
     * List producten.
     *
     * @return Json
     */
    public function index()
    {
        $products = DB::select('products', [
            'id',
            'image',
            'name',
            'description',
            'price [Number]',
        ], []);

        return $this->respondJson(
            '',
            $products
        );
    }

    /**
     * Create producten.
     *
     * @param object $request
     *
     * @return Html
     */
    public function create($request)
    {
        try {
            ProductsValidator::create($request->data);
        } catch (Exception $e) {
            return $this->respondJson(
                'De data was incorrect',
                json_decode($e->getMessage()),
                422
            );
        }

        $data = [
            'id' => UUID::v6(),
            'image' => $request->data->image,
            'name' => $request->data->name,
            'description' => $request->data->description,
            'price' => $request->data->price,
        ];

        DB::create('products', $data);

        return $this->respondJson(
            'Product Aangemaakt',
            $data
        );
    }

    /**
     * Update producten.
     *
     * @param object $request
     * @param string $id
     *
     * @return Html
     */
    public function update($request, $id)
    {
        try {
            ProductsValidator::update($request->data);
        } catch (Exception $e) {
            return $this->respondJson(
                'De data was incorrect',
                json_decode($e->getMessage()),
                422
            );
        }

        $product = DB::get('products', [
            'image',
            'name',
            'description',
            'price',
        ], ['id' => $id]);

        if (!$product) {
            return $this->respondJson(
                'Product niet gevonden',
                [],
                404
            );
        }

        $data = [
            'image' => $request->data->image ?: $product['image'],
            'name' => $request->data->name ?: $product['name'],
            'description' => $request->data->description ?: $product['description'],
            'price' => $request->data->price ?: $product['price'],
        ];

        DB::update(
            'products',
            $data,
            [
                'id' => $id,
            ]
        );

        return $this->respondJson(
            'Product Updated',
            $data
        );
    }

    /**
     * Delete producten.
     *
     * @param string $id
     *
     * @return Html
     */
    public function delete($id)
    {
        DB::delete('products', ['id' => $id]);

        return $this->respondJson('Product Verwijderd');
    }
}
