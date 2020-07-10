<?php
namespace Budgetlens\PostNLApi\Client\Middleware;

/**
 * Request Exception
 */
use Budgetlens\PostNLApi\Client\Middleware\JsonResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestException extends \GuzzleHttp\Exception\RequestException
{
    public static function create(
        RequestInterface $request,
        ResponseInterface $response = null,
        \Throwable $previous = null,
        array $ctx = []
    ): \GuzzleHttp\Exception\RequestException {
        if ($response === null || !($response->getBody() instanceof JsonResponse)) {
            return parent::create($request, $response);
        }

        throw new ErrorResponseException('Error', $response->getStatusCode(), $response->getBody()->json());
    }
}
