<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

/**
 * Class Request
 * @package App\Http\Requests
 */
abstract class Request extends FormRequest
{
    /**
     * {@inheritdoc}
     */
    protected function formatErrors(Validator $validator)
    {
        return [
            'error' => 'invalid_input',
            'errors' => $validator->getMessageBag()->toArray()
        ];
    }
}
