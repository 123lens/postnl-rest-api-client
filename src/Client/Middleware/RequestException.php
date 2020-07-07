<?php
namespace Budgetlens\PostNLApi\Client\Middleware;

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

        try {
            $errorResponse = $response->getBody()->json();
        } catch (\InvalidArgumentException $exception) {
            return parent::create($request, $response);
        }

        $additional = '';
        if (isset($errorResponse['violations'])) {
            $additional .= implode(', ', array_map(static function ($violation) {
                if (isset($violation['name'])) {
                    return "`{$violation['name']}`: {$violation['reason']}";
                }
                return $violation['reason'];
            }, $errorResponse['violations']));
        }

        $newResponse = $response->withStatus(
            $response->getStatusCode(),
            sprintf('%s: %s', $errorResponse['detail'], $additional)
        );

        return parent::create($request, $newResponse);
    }
}
