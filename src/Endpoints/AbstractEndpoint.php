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

    /**
     * Create Request Object
     * @param $class
     * @param array $parameters
     * @return mixed
     */
    public function createRequest($class, array $parameters = [])
    {
        $obj = new $class($this->client);
        return $obj->initialize($parameters);
    }
}
