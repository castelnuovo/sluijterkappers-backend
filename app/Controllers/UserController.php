<?php

namespace App\Controllers;

use CQ\DB\DB;
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
            "overig" => $overig,
        ];

        return $this->respond('dashboard.twig', [
            'products' => $products,
        ]);
    }
}
