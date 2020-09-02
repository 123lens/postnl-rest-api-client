<?php
namespace Budgetlens\PostNLApi\Client\Middleware;

/**
 * Request Exception
 */
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
        return parent::create($request, $response);
    }
}
