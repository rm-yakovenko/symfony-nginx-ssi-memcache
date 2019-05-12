<?php

namespace App\HttpCache;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface HttpCacheInterface
{
    public function handleResponse(Request $request, Response $response): void;
}
