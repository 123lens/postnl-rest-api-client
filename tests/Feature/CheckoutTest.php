<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Checkout\Warning;
use Budgetlens\PostNLApi\Entities\DeliveryDateOption;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Entities\OpeningHour;
use Budgetlens\PostNLApi\Entities\PickupOption;
use Budgetlens\PostNLApi\Messages\Responses\CheckoutResponse;
use Budgetlens\PostNLApi\Messages\Responses\PostalcodeCheckResponse;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    /**
     * @test
     */
    public function postalcodeCheck()
    {
        $request = $this->getClient('Checkout/postalcodeCheckSuccess.json')->checkout()->postalcodeCheck();
        $request->setPostalcode('1000AA');
        $request->setHouseNumber(1);
        $response = $request->send();
        $this->assertInstanceOf(PostalcodeCheckResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertSame('Straat', $response->getStreetName());
    }

    /**
     * @test
     */
    public function checkoutSingle()
    {
        $request = $this->getClient('Checkout/checkoutSingleWithWarningsSuccess.json')->checkout()->checkout();
        $request->setOrderDate(new \DateTime());
        $request->setShippingDuration(1);
        $request->addCutOffTime('01', true, '16:00:00');
        $request->setHolidaySorting(true);
        $request->addDeliveryOption('Daytime');
        $request->setLocations(3);
        $request->setDays(1);
        $request->addAddress([
            "AddressType" => "01",
            "HouseNr" => 1,
            "Zipcode" => "1000AA",
            "Countrycode" => "NL"
        ]);
        $response = $request->send();
        $this->assertInstanceOf(CheckoutResponse::class, $response);
        $this->assertIsArray($response->getDeliveryOptions());
        $this->assertIsArray($response->getWarnings());
        $this->assertCount(1, $response->getDeliveryOptions());
        $this->assertCount(1, $response->getWarnings());
        $this->assertInstanceOf(DeliveryDateOption::class, $response->getDeliveryOptions()[0]);
        $this->assertInstanceOf(\DateTime::class, $response->getDeliveryOptions()[0]->getDeliveryDate());
        $this->assertSame('2020-07-10', $response->getDeliveryOptions()[0]->getDeliveryDate()->format("Y-m-d"));
        $this->assertCount(1, $response->getDeliveryOptions()[0]->getTimeFrame());
        $this->assertInstanceOf(Warning::class, $response->getWarnings()[0]);
        $this->assertSame('2020-07-09', $response->getWarnings()[0]->getDeliveryDate()->format("Y-m-d"));
        $this->assertSame('08', $response->getWarnings()[0]->getCode());
    }

    /**
     * @test
     */
    public function checkoutMultiple()
    {
        $request = $this->getClient('Checkout/checkoutMultipleDatesWithWarningsSuccess.json')->checkout()->checkout();
        $request->setOrderDate((new \DateTime())->add(new \DateInterval("P2D")));
        $request->setShippingDuration(1);
        $request->addCutOffTime('01', true, '16:00:00');
        $request->setHolidaySorting(true);
        $request->addDeliveryOption('Daytime');
        $request->setLocations(3);
        $request->setDays(3);
        $request->addAddress([
            "AddressType" => "01",
            "HouseNr" => 1,
            "Zipcode" => "1000AA",
            "Countrycode" => "NL"
        ]);
        $response = $request->send();
        $this->assertInstanceOf(CheckoutResponse::class, $response);
        $this->assertIsArray($response->getDeliveryOptions());
        $this->assertIsArray($response->getWarnings());
        $this->assertCount(3, $response->getDeliveryOptions());
        $this->assertCount(2, $response->getWarnings());
        $this->assertInstanceOf(DeliveryDateOption::class, $response->getDeliveryOptions()[0]);
        $this->assertInstanceOf(\DateTime::class, $response->getDeliveryOptions()[0]->getDeliveryDate());
        $this->assertSame('2020-07-13', $response->getDeliveryOptions()[0]->getDeliveryDate()->format("Y-m-d"));
        $this->assertSame('2020-07-14', $response->getDeliveryOptions()[1]->getDeliveryDate()->format("Y-m-d"));
        $this->assertCount(1, $response->getDeliveryOptions()[0]->getTimeFrame());
        $this->assertInstanceOf(Warning::class, $response->getWarnings()[0]);
        $this->assertSame('2020-07-11', $response->getWarnings()[0]->getDeliveryDate()->format("Y-m-d"));
        $this->assertSame('08', $response->getWarnings()[0]->getCode());
        $this->assertSame('03', $response->getWarnings()[1]->getCode());
    }

    /**
     * @test
     */
    public function checkoutMultipleWithPickupPoints()
    {
        $request = $this->getClient('Checkout/checkoutMultipleDatesWithPickupLocationsWithWarningsSuccess.json')->checkout()->checkout();
        $request->setOrderDate((new \DateTime())->add(new \DateInterval("P2D")));
        $request->setShippingDuration(1);
        $request->addCutOffTime('01', true, '16:00:00');
        $request->setHolidaySorting(true);
        $request->addDeliveryOption('Daytime');
        $request->addDeliveryOption('Pickup');
        $request->setLocations(3);
        $request->setDays(3);
        $request->addAddress([
            "AddressType" => "01",
            "HouseNr" => 1,
            "Zipcode" => "1000AA",
            "Countrycode" => "NL"
        ]);
        $response = $request->send();
        $this->assertInstanceOf(CheckoutResponse::class, $response);
        $this->assertIsArray($response->getDeliveryOptions());
        $this->assertIsArray($response->getPickupOptions());
        $this->assertIsArray($response->getWarnings());
        $this->assertCount(3, $response->getDeliveryOptions());
        $this->assertCount(1, $response->getPickupOptions());
        $this->assertCount(2, $response->getWarnings());
        $this->assertCount(3, $response->getPickupOptions()[0]->getLocations());
        $this->assertInstanceOf(Location::class, $response->getPickupOptions()[0]->getLocations()[0]);
        $this->assertInstanceOf(DeliveryDateOption::class, $response->getDeliveryOptions()[0]);
        $this->assertInstanceOf(\DateTime::class, $response->getDeliveryOptions()[0]->getDeliveryDate());
        $this->assertSame('2020-07-13', $response->getDeliveryOptions()[0]->getDeliveryDate()->format("Y-m-d"));
        $this->assertSame('2020-07-14', $response->getDeliveryOptions()[1]->getDeliveryDate()->format("Y-m-d"));
        $this->assertCount(1, $response->getDeliveryOptions()[0]->getTimeFrame());
        $this->assertInstanceOf(Warning::class, $response->getWarnings()[0]);
        $this->assertSame('2020-07-11', $response->getWarnings()[0]->getDeliveryDate()->format("Y-m-d"));
        $this->assertSame('08', $response->getWarnings()[0]->getCode());
        $this->assertSame('03', $response->getWarnings()[1]->getCode());
        $this->assertInstanceOf(PickupOption::class, $response->getPickupOptions()[0]);
        $this->assertInstanceOf(Address::class, $response->getPickupOptions()[0]->getLocations()[0]->getAddress());
        $this->assertCount(7, $response->getPickupOptions()[0]->getLocations()[0]->getOpeningHours());
        $this->assertInstanceOf(OpeningHour::class, $response->getPickupOptions()[0]->getLocations()[0]->getOpeningHours()[0]);
        $this->assertSame('8573211819', $response->getPickupOptions()[0]->getLocations()[0]->getLocationCode());
        $this->assertSame('2020-07-13', $response->getPickupOptions()[0]->getPickupDate()->format("Y-m-d"));
    }
}
