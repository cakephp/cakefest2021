<?php
declare(strict_types=1);

namespace App\Middleware;

use Cake\Cache\Cache;
use Cake\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * FullCache middleware
 */
class FullCacheMiddleware implements MiddlewareInterface
{
    /**
     * Process method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler The request handler.
     * @return \Psr\Http\Message\ResponseInterface A response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getUri()->getPath() !== "/") {
            return $handler->handle($request);
        }

        if ($responseBody = Cache::read('homepage')) {
            return (new Response())->withStringBody($responseBody);
        }
        $response = $handler->handle($request);
        Cache::write('homepage', (string)$response->getBody());

        return $response;
    }
}
