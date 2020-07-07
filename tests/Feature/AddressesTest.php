<?php
namespace Tests\Feature;

use Tests\TestCase;

class AddressesTest extends TestCase
{
    /**
     * @test
     */
    public function getAddressByPostalcodeAndHousenumber()
    {
        $response = $this->getClient()->addresses()->getAddressByPostalcodeAndHouseNumber('1411XC', 22);
    }
}
