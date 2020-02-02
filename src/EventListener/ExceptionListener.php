<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $body      = [
            'error' => $exception->getMessage(),
        ];

        if ($exception instanceof HttpExceptionInterface) {
            $response = new JsonResponse($body, $exception->getStatusCode());
        } else {
            /* TODO log the exception */
        }

        $event->setResponse($response);
    }
}
