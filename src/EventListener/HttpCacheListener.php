<?php


namespace App\EventListener;

use App\HttpCache\HttpCacheInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class HttpCacheListener implements EventSubscriberInterface
{
    /**
     * @var HttpCacheInterface
     */
    private $httpCache;

    public function __construct(HttpCacheInterface $httpCache)
    {
        $this->httpCache = $httpCache;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => 'onResponse',
        ];
    }

    public function onResponse(FilterResponseEvent $event)
    {
        $this->httpCache->handleResponse($event->getRequest(), $event->getResponse());
    }
}
