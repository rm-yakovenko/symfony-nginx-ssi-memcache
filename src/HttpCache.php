<?php


namespace App;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpCache
{
    /**
     * @var \Memcached
     */
    private $memcached;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * HttpCache constructor.
     * @param \Memcached $memcached
     * @param LoggerInterface $logger
     */
    public function __construct(\Memcached $memcached, LoggerInterface $logger)
    {
        $this->memcached = $memcached;
        $this->logger = $logger;
    }

    public function handleResponse(Request $request, Response $response) : void
    {
        if (!$response->isCacheable()) {
            return;
        }

        $cacheKey = $this->getCacheKey($request);
        if (!$this->memcached->set($cacheKey, $response->getContent(), $response->getMaxAge())) {
            $this->logger->critical("[HttpCache] Failed to store response: {$this->memcached->getLastErrorMessage()}.");
        }
    }

    protected function getCacheKey(Request $request): string
    {
        return "{$request->getPathInfo()}?{$request->getQueryString()}";
    }
}
