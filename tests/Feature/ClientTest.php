<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\RestApiClient;
use Tests\TestCase;

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
