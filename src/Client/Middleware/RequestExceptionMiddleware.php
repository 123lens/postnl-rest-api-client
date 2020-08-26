<?php
namespace Budgetlens\PostNLApi\Client\Middleware;

use Budgetlens\PostNLApi\Exceptions\ApiException;
use Budgetlens\PostNLApi\Exceptions\CifDownException;
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

                        $json = $response->getBody()->json();
                        print_r($json);
                        exit;
                        if (!empty($json['fault']['faultstring']) && $json['fault']['faultstring'] === 'Invalid ApiKey') {
                            throw new ApiException('Invalid Api Key');
                        }
                        if (isset($json['Envelope']['Body']['Fault']['Reason']['Text'][''])) {
                            throw new CifDownException($json['Envelope']['Body']['Fault']['Reason']['Text']['']);
                        }

                        print_r($request->getBody()->json());
                        exit;

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
