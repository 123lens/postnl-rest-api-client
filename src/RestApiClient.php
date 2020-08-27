<?php
namespace Budgetlens\PostNLApi;

use Budgetlens\PostNLApi\Client\HttpClient;
use Budgetlens\PostNLApi\Client\HttpClientConfig;
use Budgetlens\PostNLApi\Endpoints\Addresses;
use Budgetlens\PostNLApi\Endpoints\Barcode;
use Budgetlens\PostNLApi\Endpoints\Checkout;
use Budgetlens\PostNLApi\Endpoints\Deliverydate;
use Budgetlens\PostNLApi\Endpoints\Labelling;
use Budgetlens\PostNLApi\Endpoints\Locations;
use Budgetlens\PostNLApi\Endpoints\Shipping;
use Budgetlens\PostNLApi\Endpoints\ShippingStatus;
use Budgetlens\PostNLApi\Endpoints\Timeframe;
use Budgetlens\PostNLApi\Endpoints\Company;
use Budgetlens\PostNLApi\Endpoints\Confirming;
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

    /**
     * Address endpoint
     * @return Addresses
     */
    public function addresses(): Addresses
    {
        return new Addresses($this->client);
    }

    /**
     * Locations endpoint
     * @return Locations
     */
    public function locations(): Locations
    {
        return new Locations($this->client);
    }

    /**
     * Checkout endpoint
     * @return Checkout
     */
    public function checkout(): Checkout
    {
        return new Checkout($this->client);
    }

    /**
     * Delivery Date Endpoint
     * @return Deliverydate
     */
    public function deliveryDate(): Deliverydate
    {
        return new Deliverydate($this->client);
    }

    /**
     * Timeframe Endpoint
     * @return Timeframe
     */
    public function timeframe(): Timeframe
    {
        return new Timeframe($this->client);
    }

    /**
     * Company Endpoint
     * @return Company
     */
    public function company(): Company
    {
        return new Company($this->client);
    }

    /**
     * Barcode Endpoint
     * @return Barcode
     */
    public function barcode(): Barcode
    {
        return new Barcode($this->client);
    }

    /**
     * Labelling Endpoint
     * @return Labelling
     */
    public function labelling(): Labelling
    {
        return new Labelling($this->client);
    }

    /**
     * Confirming Endpoint
     * @return Confirming
     */
    public function confirming(): Confirming
    {
        return new Confirming($this->client);
    }

    /**
     * Shipping Endpoint
     * @return Shipping
     */
    public function shipping(): Shipping
    {
        return new Shipping($this->client);
    }

    /**
     *  ShippingStatus Endpoint
     * @return ShippingStatus
     */
    public function shippingStatus(): ShippingStatus
    {
        return new ShippingStatus($this->client);
    }
}
