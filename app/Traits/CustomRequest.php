<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait CustomRequest
{
    use ApiResponse;
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error($this->message??'Validation Error', 422, $validator->errors()));
    }
}
