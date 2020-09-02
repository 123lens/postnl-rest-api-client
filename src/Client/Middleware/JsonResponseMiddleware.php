<?php
namespace Budgetlens\PostNLApi\Client\Middleware;

/**
 * Response to json middleware
 */

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class JsonResponseMiddleware
{
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            return $handler($request, $options)->then(
                function (ResponseInterface $response) {
                    return $response->withBody(new JsonResponse($response->getBody()));
                }
            );
        };
    }
}
