<?php
namespace Budgetlens\PostNLApi\Endpoints;

use GuzzleHttp\ClientInterface;

/**
 * Abstract Endpoint
 *
 * Class AbstractEndpoint
 * @package Budgetlens\PostNLApi\Endpoints
 */

class AbstractEndpoint
{
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
