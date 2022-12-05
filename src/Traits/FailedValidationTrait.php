<?php

namespace IbrahimHalilUcan\ResponseBuilder\Traits;

use Illuminate\Contracts\Validation\Validator;
use IbrahimHalilUcan\ResponseBuilder\Facades\ResponseBuilder;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

trait FailedValidationTrait
{
    /**
     * @param Validator $validator
     * @return mixed
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = ResponseBuilder::error($validator->errors())
            ->httpStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->append(['message' => 'The given data is invalid'])
            ->build();

        throw new ValidationException($validator, $response);
    }
}
