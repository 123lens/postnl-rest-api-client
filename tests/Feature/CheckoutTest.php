<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Messages\Responses\LocationLookupResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByAreaResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByGeoResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;
use Budgetlens\PostNLApi\Messages\Responses\PostalcodeCheckResponse;
use GuzzleHttp\Exception\ClientException;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    /**
     * @test
     */
    public function postalcodeCheck()
    {
        $request = $this->getClient('Checkout/postalcodeCheckSuccess.json')->checkout()->postalcodeCheck();
        $request->setPostalcode('1411XC');
        $request->setHouseNumber(22);
        $response = $request->send();
        $this->assertInstanceOf(PostalcodeCheckResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertSame('Straat', $response->getStreetName());
    }
}
