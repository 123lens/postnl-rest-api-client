<?php
namespace Budgetlens\PostNLApi\Client\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ResponseIsErrorMiddleware
{
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            return $handler($request, $options)->then(
                function (ResponseInterface $response) use ($request) {
                    if ($response->getBody() instanceof JsonResponse) {
                        // response got error?
                        $errorResponse = $response->getBody()->json();
                        $error = $errorResponse['Error'] ?? [];
                        if (count($error) === 0) {
                            // no error
                            return $response;
                        } else {
                            // response contains errors.
                            $newResponse = $response->withStatus(
                                404,
                                sprintf('%s: %s', $error['ErrorMsg'], $error['ErrorNumber'])
                            );
                            throw RequestException::create($request, $response);
                        }
                    }
                }
            );
        };
    }
}
