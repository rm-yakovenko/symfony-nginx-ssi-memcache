# Symfony Nginx SSI Memcache

Caching html blocks with nginx and memcached. 

# Usage

1. `docker-compose up -d` to start the containers. 
1. `docker-compose run --rm app composer install` install dependencies.
1. `curl http://127.0.0.1:1345/` to hit the cache.
1. `curl http://127.0.0.1:1345/ -H 'X-Bypass-secret: 1'` to bypass the cache.