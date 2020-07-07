<?php
namespace Budgetlens\PostNLApi\Client\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestExceptionMiddleware
{
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            return $handler($request, $options)->then(
                function (ResponseInterface $response) use ($request) {
                    $code = $response->getStatusCode();
                    if ($code < 400) {
                        return $response;
                    }

                    throw RequestException::create($request, $response);
                }
            );
        };
    }
}
