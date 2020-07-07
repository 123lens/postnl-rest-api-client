<?php
namespace Budgetlens\PostNLApi\Client;

/**
 * Guzzle Http Client
 */

use Budgetlens\PostNLApi\Client\Contracts\HttpClientConfigInterface;
use Budgetlens\PostNLApi\Client\Middleware\JsonResponseMiddleware;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Utils;
use Psr\Log\LoggerInterface;

class HttpClient extends Client
{
    /**
     * @var string - User Agent
     */
    private string $userAgent;

    public function __construct(
        HttpClientConfigInterface $httpClientConfig,
        LoggerInterface $logger = null,
        string $userAgent = 'budgetlens/postnl-rest-client-agent/0.1.0'
    ) {
        $this->userAgent = $userAgent;
        $stack = $this->handlerStack($logger);
        $headers = $this->headers($httpClientConfig);

        parent::__construct([
            'handler' => $stack,
            'base_uri' => $httpClientConfig->getApiUrl(),
            'headers' => $headers,
            'connect_timeout' => $httpClientConfig->getConnectionTimeout()
        ]);
    }

    /**
     * Set Guzzle Handler Stack
     * @param LoggerInterface|null $logger
     * @return HandlerStack
     */
    protected function handlerStack(LoggerInterface $logger = null): HandlerStack
    {
        $stack = new HandlerStack(Utils::chooseHandler());
        $stack->push(Middleware::redirect(), 'allow_redirects');
        if ($logger) {
            $stack->push(Middleware::log($logger, new MessageFormatter()));
        }
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
