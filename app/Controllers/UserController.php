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
        $products = DB::select(
            'products',
            [
                'id',
                'image',
                'name',
                'description',
                'price',
            ],
            []
        );

        return $this->respond('dashboard.twig', [
            'products' => $products,
        ]);
    }
}
