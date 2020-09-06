<?php

namespace App\Controllers;

use CQ\DB\DB;
use CQ\Config\Config;
use CQ\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Dashboard screen.
     *
     * @return Html
     */
    public function dashboard()
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

        return $this->respond('dashboard.twig', [
            'products' => $products,
            'assets_key' => Config::get('assets.key'),
        ]);
    }

    /**
     * Reviews screen.
     *
     * @return Html
     */
    public function reviews()
    {
        $reviews = DB::select('reviews', [
            'id',
            'score',
            'name',
            'description',
        ], []);

        return $this->respond('reviews.twig', [
            'reviews' => $reviews,
        ]);
    }
}
