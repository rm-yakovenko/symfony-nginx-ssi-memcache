<?php


namespace App\EventListener;

use App\HttpCache;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MemcachedCacheListener implements EventSubscriberInterface
{
    /**
     * @var HttpCache
     */
    private $httpCache;

    /**
     * MemcachedCacheListener constructor.
     * @param HttpCache $httpCache
     */
    public function __construct(HttpCache $httpCache)
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
