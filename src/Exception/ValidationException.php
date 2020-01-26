<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class ValidationException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
