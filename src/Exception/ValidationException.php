<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ValidationException extends \Exception implements HttpExceptionInterface
{
    public function __construct($message)
    {
        parent::__construct($message);
    }

    /**
     * Returns the status code.
     *
     * @return int An HTTP response status code
     */
    public function getStatusCode()
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    /**
     * Returns response headers.
     *
     * @return array Response headers
     */
    public function getHeaders()
    {

    }
}
