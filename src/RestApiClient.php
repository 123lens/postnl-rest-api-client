<?php
namespace Budgetlens\PostNLApi;

use Budgetlens\PostNLApi\Client\HttpClient;
use Budgetlens\PostNLApi\Client\HttpClientConfig;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;

class RestApiClient
{
    /**
     * Rest API Client version
     */
    const LIB_VERSION = "0.1.0";

    /**
     * PostNL API Key
     * @var string|null
     */
    private ?string $apiKey;

    /**
     * @var bool - Test Mode
     */
    private bool $testMode;

    /**
     * @var LoggerInterface
     */
    private ?LoggerInterface $logger;

    /**
     * @var GuzzleHttp\ClientInterface
     */
    private $client;

    public function __construct(
        string $apiKey = null,
        bool $testMode = false,
        LoggerInterface $logger = null
    ) {

        $this->apiKey = $apiKey;
    }
    public function getHttpClient()
    {
        return $this->client;
    }

    /**
     * Set HttpClient
     * @param ClientInterface $client
     */
    public function setHttpClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Set Default Http client if no client was set
     */
    private function setDefaultClient(): void
    {
        $this->setHttpClient(new HttpClient(
            new HttpClientConfig($this->apiKey, $this->testMode),
            $this->logger,
            "budgetlens/postnl-rest-client-agent/" . static::LIB_VERSION
        ));
    }
}
