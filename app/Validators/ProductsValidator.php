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
        $v = v::attribute('image', v::url()->length(1, 2048))
        ->attribute('name', v::stringType()->length(1, 128))
        ->attribute('price', v::numericVal())
        ->attribute('category', v::oneOf(
            v::equals('kerastase'),
            v::equals('loreal'),
            v::equals('tecni_art'),
            v::equals('marc_inbane'),
            v::equals('overig')
        ));

        self::validate($v, $data);
    }

    /**
     * Validate json submission.
     *
     * @param object $data
     */
    public static function update($data)
    {
        $v = v::attribute('image', v::optional(v::url()->length(1, 2048)))
        ->attribute('name', v::optional(v::stringType()->length(1, 128)))
        ->attribute('price', v::optional(v::numericVal()));

        self::validate($v, $data);
    }
}
