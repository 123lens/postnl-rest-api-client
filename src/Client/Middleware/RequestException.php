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

        $errorResponse = $response->getBody()->json();
        $error = $errorResponse['Error'] ?? [];
        if (count($error) === 0) {
            return parent::create($request, $response);
        }

        $newResponse = $response->withStatus(
            404,
            sprintf('%s: %s', $error['ErrorMsg'], $error['ErrorNumber'])
        );

        return parent::create($request, $newResponse);
    }
}
