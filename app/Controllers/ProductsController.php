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
        $kerastase = DB::select('products', [
            'id',
            'image',
            'name',
            'price [Number]',
        ], ['category' => 'kerastase']);

        $loreal = DB::select('products', [
            'id',
            'image',
            'name',
            'price [Number]',
        ], ['category' => 'loreal']);

        $tecni_art = DB::select('products', [
            'id',
            'image',
            'name',
            'price [Number]',
        ], ['category' => 'tecni_art']);

        $marc_inbane = DB::select('products', [
            'id',
            'image',
            'name',
            'price [Number]',
        ], ['category' => 'marc_inbane']);

        $double_true = DB::select('products', [
            'id',
            'image',
            'name',
            'price [Number]',
        ], ['category' => 'double_true']);

        $overig = DB::select('products', [
            'id',
            'image',
            'name',
            'price [Number]',
        ], ['category' => 'overig']);

        $products = [
            "kerastase" => $kerastase,
            "loreal" => $loreal,
            "tecni_art" => $tecni_art,
            "marc_inbane" => $marc_inbane,
            "double_true" => $double_true,
            "overig" => $overig,
        ];

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
            'price' => $request->data->price,
            'category' => $request->data->category,
        ];

        DB::create('products', $data);

        return $this->respondJson('Product Aangemaakt', [
            'reload' => true,
        ]);
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
            'price',
            'category',
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
            'price' => $request->data->price ?: $product['price'],
        ];

        DB::update(
            'products',
            $data,
            [
                'id' => $id,
            ]
        );

        return $this->respondJson('Product Updated', [
            'reload' => true,
        ]);
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

        return $this->respondJson('Product Verwijderd', [
            'reload' => true,
        ]);
    }
}
