<?php
namespace Budgetlens\PostNLApi\Client\Middleware;

/**
 * Response to Json decorator
 */

use GuzzleHttp\Psr7\StreamDecoratorTrait;
use GuzzleHttp\Utils;
use Psr\Http\Message\StreamInterface;

class JsonResponse implements StreamInterface
{
    use StreamDecoratorTrait;

    public function json()
    {
        return Utils::jsonDecode((string)$this, true);
    }
}
