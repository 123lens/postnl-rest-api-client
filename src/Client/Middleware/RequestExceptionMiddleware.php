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
                    if ($response === null || !($response->getBody() instanceof JsonResponse)) {
                        throw RequestException::create($request, $response);
                    } else {
                        // json formatted error response from PostNL
                        throw new ErrorResponseException(
                            'Error',
                            $response->getStatusCode(),
                            $response->getBody()->json()
                        );
                    }
                }
            );
        };
    }
}
