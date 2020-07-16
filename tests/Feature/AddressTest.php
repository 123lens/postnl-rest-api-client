<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Entities\Address\Geo;
use Budgetlens\PostNLApi\Messages\Responses\Addresses\Geo\AddressCheckResponse;
use Budgetlens\PostNLApi\Messages\Responses\Addresses\National\ValidateAddressResponse;
use Tests\TestCase;

class AddressTest extends TestCase
{
    /**
     * @test
     */
    public function validateAddressNational()
    {
        $request = $this->getClient('Addresses/AddressCheckNational/ValidateAddressSuccess.json')->addresses()->validateAddressCheckNational();
        $request->setPostalCode('1000AA')
            ->setCity('Plaats')
            ->setStreet('Straat')
            ->setHouseNumber(1)
            ->setAddition('');
        $response = $request->send();
        $this->assertInstanceOf(ValidateAddressResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertSame('HOOFDDORP', $response->getCity());
        $this->assertSame('2132WT', $response->getPostalCode());
        $this->assertIsArray($response->getFormattedAddress());
    }

    /**
     * @test
     */
    public function geoAddressCheckNational()
    {
        $request = $this->getClient('Addresses/AddressCheckGeo/geoAddressCheckSuccess.json')->addresses()->geoAddressCheckNational();
        $request->setPostalCode('1000AA')
            ->setCity('Plaats')
            ->setStreet('Straat')
            ->setHouseNumber(1)
            ->setAddition('');
        $response = $request->send();
        $this->assertInstanceOf(AddressCheckResponse::class, $response);
        $this->assertInstanceOf(Geo::class, $response->getGeo());
        $this->assertIsArray($response->getData());
        $this->assertSame('HOOFDDORP', $response->getCity());
        $this->assertSame('2132WT', $response->getPostalCode());
        $this->assertIsArray($response->getFormattedAddress());
    }
}

