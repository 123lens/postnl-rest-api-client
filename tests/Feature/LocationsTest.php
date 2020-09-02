<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Client\Middleware\ErrorResponseException;
use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Messages\Responses\LocationLookupResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByAreaResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByGeoResponse;
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
        $this->assertSame(1, $response->getLocations()[0]->getAddress()->getHouseNr());
    }

    /**
     * @test
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
        $this->assertSame(10, $response->getLocations()[0]->getAddress()->getHouseNr());
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
        $this->assertSame(3, $response->getLocations()[0]->getAddress()->getHouseNr());
    }

    /**
     * @test
     */
    public function locationLookup()
    {
        $request = $this->getClient('Locations/locationLookupSuccess.json')->locations()->locationLookup();
        $request->setLocationCode('161503');
        $request->setRetailNetworkID('PNPNL-01');
        $response = $request->send();
        $this->assertInstanceOf(LocationLookupResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertInstanceOf(Location::class, $response->getLocation());
        // assert address data.
        $this->assertInstanceOf(Address::class, $response->getLocation()->getAddress());
        $this->assertSame('2132PZ', $response->getLocation()->getAddress()->getZipcode());
        $this->assertSame(10, $response->getLocation()->getAddress()->getHouseNr());
    }

    /**
     * @test
     */
    public function locationLookupException()
    {
        $this->expectException(ErrorResponseException::class);
        $request = $this->getClient('ErrorResponse.json', 400)->locations()->locationLookup();
        $request->setLocationCode('161503');
        $request->setRetailNetworkID('PNPNL-01');
        $request->send();
    }
}
