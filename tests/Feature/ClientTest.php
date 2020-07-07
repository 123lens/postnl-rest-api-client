<?php
namespace Tests;

use Budgetlens\PostNLApi\RestApiClient;

/**
 * Basic client tests
 * Class ClientTest
 * @package Tests
 */

class ClientTest extends TestCase
{
    /**
     * @test
     */
    public function clientInitiated()
    {
        $this->assertInstanceOf(RestApiClient::class, $this->getClient());
    }
}
