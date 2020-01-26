<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $body      = [
            'error' => $exception->getMessage(),
        ];

        if ($exception->getCode() < 500 && 0 != $exception->getCode()) {
            $response = new JsonResponse($body, $exception->getCode());
        } else {
            /* TODO log the exception */
        }

        $event->setResponse($response);
    }
}
