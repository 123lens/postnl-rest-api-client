<?php
namespace Tests\Client;

use Budgetlens\PostNLApi\Client\Contracts\HttpClientConfigInterface;
use Budgetlens\PostNLApi\Client\HttpClientConfig;
use Budgetlens\PostNLApi\Client\Middleware\JsonResponseMiddleware;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Utils;
use Psr\Log\LoggerInterface;

/**
 * Mockery http client
 *
 * Class HttpClient
 * @package tests\Client
 */

class HttpClient extends Client
{
    /**
     * @var string - User Agent
     */
    private $userAgent;
    /**
     * @var MockHandler
     */
    private $mockHandler;

    public function __construct(
        $apiKey,
        ?MockHandler $mockHandler = null
    ) {
        $httpClientConfig = new HttpClientConfig($apiKey, true);
        $this->userAgent = 'budgetlens/postnl-rest-client-agent-unit-test/0.1.0';
        $stack = $this->handlerStack($mockHandler);
        // headers
        $headers = $this->headers($httpClientConfig);

        // construct http client
        parent::__construct([
            'handler' => $stack,
            'base_uri' => $httpClientConfig->getApiUrl(),
            'headers' => $headers,
            'connect_timeout' => $httpClientConfig->getConnectionTimeout()
        ]);
    }


    /**
     * Set Guzzle Handler Stack
     * @return HandlerStack
     */
    protected function handlerStack(?MockHandler $mockHandler = null): HandlerStack
    {
        if ($mockHandler) {
            $stack = HandlerStack::create($mockHandler);
        } else {
            $stack = new HandlerStack(Utils::chooseHandler());
        }
        $stack->push(Middleware::redirect(), 'allow_redirects');
        $stack->push(new JsonResponseMiddleware());
        return $stack;
    }

    /**
     * Get Http Headers
     * @param HttpClientConfigInterface $httpClientConfig
     * @return array
     */
    protected function headers(HttpClientConfigInterface $httpClientConfig): array
    {
        return [
            'User-Agent' => $this->userAgent,
            'apikey' => $httpClientConfig->getApiKey()
        ];
    }
}
