<?php 

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ExceptionListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
       
        $response = new Response("Custom Response");
        $event->setResponse($response);

        
    }
}