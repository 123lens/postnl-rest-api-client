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

    /**
     * @test
     */
    public function execTest()
    {
        $client = $this->getClient('Addresses/AddressCheckBasic/addressSequencePostalCodeSuccess.json');
        $response = $client->getHttpClient()->get("address/sequence/v1/postalcode/?postalcode=1411XC&housenumber=22");
        print_r($response->getBody()->json());
        exit;
    }


}
