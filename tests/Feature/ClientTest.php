<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Exceptions\ApiException;
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

    // fake wrong api key

    /**
     * @test
     */
    public function clientExceptionWrongApiKey()
    {
        $this->expectException(ApiException::class);
        $request = $this->getClient('InvalidApiKeyResponse.json', 403)->deliveryDate()->calculateDeliveryDate();
        $request->setShippingDate(new \DateTime())
            ->setShippingDuration(1)
            ->setCutOffTime('16:00:00')
            ->setPostalCode('1000AA');
        $request->send();
        die("A");
    }
}
