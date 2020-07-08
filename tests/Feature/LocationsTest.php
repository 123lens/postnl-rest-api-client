<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;
use Tests\TestCase;

class LocationsTest extends TestCase
{
    /**
     * @test
     */
    public function getNearestLocations()
    {
        $request = $this->getClient('Locations/nearestLocationsSuccess.json')->locations()->nearestLocations();
        $request->setCountryCode('NL')
            ->setPostalcode('1411XC')
            ->setDeliveryOptions(['PG']);

        $response = $request->send();
        $this->assertInstanceOf(NearestLocationsResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertInstanceOf(Location::class, $response->getLocations()[0]);
        // assert address data.
        $this->assertInstanceOf(Address::class, $response->getLocations()[0]->getAddress());
        $this->assertSame('1000AA', $response->getLocations()[0]->getAddress()->getZipcode());
        $this->assertSame(1, $response->getLocations()[0]->getAddress()->getHouseNumber());
    }
}
