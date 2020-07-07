<?php
namespace Budgetlens\PostNLApi\Client;

/**
 * Http Client config
 */
use Budgetlens\PostNLApi\Client\Contracts\HttpClientConfigInterface;

class HttpClientConfig implements HttpClientConfigInterface
{
    const API_URL = "https://api.postnl.nl";
    const API_SANDBOX_URL = "https://api-sandbox.postnl.nl";

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var bool Sandbox/test mode
     */
    private $testMode = false;

    /**
     * @var int - Connection timeout
     */
    private $connectionTimeout;

    /**
     * @var string - base api url
     */
    private $apiUrl;

    public function __construct(
        string $apiKey,
        bool $testMode = false,
        int $connectionTimeout = 10
    ) {
        $this->apiKey = $apiKey;
        $this->testMode = $testMode;
        $this->connectionTimeout = $connectionTimeout;
        $this->apiUrl = $testMode === false
            ? static::API_URL
            : static::API_SANDBOX_URL;
    }

    /**
     * Get API Key
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Get API Url
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * Get Connection timeout
     * @return int
     */
    public function getConnectionTimeout(): int
    {
        return $this->connectionTimeout;
    }
}
