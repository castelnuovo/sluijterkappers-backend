<?php

namespace App\Validators;

use CQ\Validators\Validator;
use Respect\Validation\Validator as v;

class ReviewsValidator extends Validator
{
    /**
     * Validate json submission.
     *
     * @param object $data
     */
    public static function create($data)
    {
        $v = v::attribute('score', v::intVal()->between(0, 5))
        ->attribute('name', v::stringType()->length(1, 32))
        ->attribute('description', v::stringType()->length(1, 2048));

        self::validate($v, $data);
    }

    /**
     * Validate json submission.
     *
     * @param object $data
     */
    public static function update($data)
    {
        $v = v::attribute('score', v::optional(v::intVal()->between(0, 5)))
        ->attribute('name', v::optional(v::stringType()->length(1, 32)))
        ->attribute('description', v::optional(v::stringType()->length(1, 2048)));

        self::validate($v, $data);
    }
}
