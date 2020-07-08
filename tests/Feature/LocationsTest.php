<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByAreaResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByGeoResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;
use Tests\TestCase;

class LocationsTest extends TestCase
{
    /**
     * @testx
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

    /**
     * @testx
     */
    public function getNearestLocationsByGeo()
    {
        $request = $this->getClient('Locations/nearestLocationsByGeoSuccess.json')->locations()->nearestLocationsByGeo();
        $request->setLatitude(52.2864669620795);
        $request->setLongitude(4.68239055845954);
        $request->setCountryCode('NL');
        $request->setDeliveryOptions(['PG']);
        $response = $request->send();
        $this->assertInstanceOf(NearestLocationsByGeoResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertInstanceOf(Location::class, $response->getLocations()[0]);
        // assert address data.
        $this->assertInstanceOf(Address::class, $response->getLocations()[0]->getAddress());
        $this->assertSame('2132PZ', $response->getLocations()[0]->getAddress()->getZipcode());
        $this->assertSame(10, $response->getLocations()[0]->getAddress()->getHouseNumber());
    }

    /**
     * @test
     */
    public function getNearestLocationsByArea()
    {
        $request = $this->getClient('Locations/nearestLocationsByAreaSuccess.json')->locations()->nearestLocationsByArea();
        $request->setLatitudeNorth(52.156439);
        $request->setLongitudeWest(5.015643);
        $request->setLatitudeSouth(52.017473);
        $request->setLongitudeEast(5.065254);
        $request->setCountryCode('NL');
        $request->setDeliveryOptions(['PG']);
        $response = $request->send();
        $this->assertInstanceOf(NearestLocationsByAreaResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertInstanceOf(Location::class, $response->getLocations()[0]);
        // assert address data.
        $this->assertInstanceOf(Address::class, $response->getLocations()[0]->getAddress());
        $this->assertSame('3454CJ', $response->getLocations()[0]->getAddress()->getZipcode());
        $this->assertSame(3, $response->getLocations()[0]->getAddress()->getHouseNumber());
    }
}
