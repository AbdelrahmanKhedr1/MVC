<?php

namespace Iliuminates\Http\Controllers;

use Iliuminates\Http\Validations\Validation;

class BaseController
{
    /**
     * @param array|object $requests
     * @param array $rules
     * @param array $attributes
     * @return Validation
     */
    public function validate(array|object $requests, array $rules, array|null $attributes = [])
    {
        return Validation::make($requests, $rules, $attributes);
    }
}
