<?php

namespace App\Validators;

use CQ\Validators\Validator;
use Respect\Validation\Validator as v;

class ProductsValidator extends Validator
{
    /**
     * Validate json submission.
     *
     * @param object $data
     */
    public static function create($data)
    {
        $v = v::attribute('image', v::alnum(' ', '-')->length(1, 2048))
        ->attribute('name', v::alnum(' ', '-')->length(1, 128))
        ->attribute('description', v::alnum(' ', '-')->length(1, 2048))
        ->attribute('price', v::alnum(' ', '-')->length(1, 6));

        self::validate($v, $data);
    }

    /**
     * Validate json submission.
     *
     * @param object $data
     */
    public static function update($data)
    {
        $v = v::attribute('image', v::optional(v::alnum()->length(1, 2048)))
        ->attribute('name', v::optional(v::alnum()->length(1, 128)))
        ->attribute('description', v::optional(v::alnum()->length(1, 2048)))
        ->attribute('price', v::optional(v::alnum()->length(1, 6)));

        self::validate($v, $data);
    }
}
