<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Client\Middleware\ErrorResponseException;
use Budgetlens\PostNLApi\Client\Middleware\RequestException;
use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Messages\Responses\DeliveryDate\CalculateDeliveryDateResponse;
use Budgetlens\PostNLApi\Messages\Responses\DeliveryDate\CalculateShippingDateResponse;
use Budgetlens\PostNLApi\Messages\Responses\LocationLookupResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByAreaResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByGeoResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;
use GuzzleHttp\Exception\ClientException;
use http\Exception\InvalidArgumentException;
use Tests\TestCase;

class DeliveryDateTest extends TestCase
{
    /**
     * @test
     */
    public function calculateDeliveryDateSuccess()
    {
        $request = $this->getClient('DeliveryDate/calculateDeliveryDateSuccess.json')->deliveryDate()->calculateDeliveryDate();
        $request->setShippingDate(new \DateTime())
            ->setShippingDuration(1)
            ->setCutOffTime('16:00:00')
            ->setPostalCode('1000AA');
        $response = $request->send();
        $this->assertInstanceOf(CalculateDeliveryDateResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertInstanceOf(\DateTime::class, $response->getDeliveryDate());
        $this->assertIsArray($response->getOptions());
        $this->assertSame('2020-07-10', $response->getDeliveryDate()->format("Y-m-d"));
    }

    /**
     * @test
     */
    public function calculateDeliveryDateFailure()
    {
        $this->expectException(ErrorResponseException::class);
        $request = $this->getClient('DeliveryDate/calculateDeliveryDateError.json', 400)->deliveryDate()->calculateDeliveryDate();
        $request->setShippingDate(new \DateTime())
            ->setCutOffTime('16:00:00')
            ->setShippingDuration(1)
            ->setPostalCode('1411XC');
        $response = $request->send();
    }

    /**
     * @test
     */
    public function calculateShippingDateSuccess()
    {
        $request = $this->getClient('DeliveryDate/calculateShippingDateSuccess.json')->deliveryDate()->calculateShippingDate();
        $request->setDeliveryDate((new \DateTime())->add(new \DateInterval("P1D")))
            ->setShippingDuration(1)
            ->setPostalCode('1411XC');
        $response = $request->send();

        $this->assertInstanceOf(CalculateShippingDateResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertInstanceOf(\DateTime::class, $response->getSendDate());
        $this->assertSame('2020-07-10', $response->getSendDate()->format("Y-m-d"));
    }

    /**
     * @test
     */
    public function calculateShippingDateError()
    {
        $this->expectException(ErrorResponseException::class);
        $request = $this->getClient('DeliveryDate/calculateShippingDateError.json', 400)->deliveryDate()->calculateShippingDate();
        $request->setDeliveryDate((new \DateTime())->add(new \DateInterval("P1D")))
            ->setShippingDuration(1)
            ->setPostalCode('1411XC');
        $response = $request->send();
    }

    /**
     * @test
     */
    public function calculateShippingDateErrorNumber()
    {
        try {
            $request = $this->getClient('DeliveryDate/calculateShippingDateError.json', 400)->deliveryDate()->calculateShippingDate();
            $request->setDeliveryDate((new \DateTime())->add(new \DateInterval("P1D")))
                ->setShippingDuration(1)
                ->setPostalCode('1411XC');
            $response = $request->send();
        } catch (ErrorResponseException $e) {
            $this->assertSame(2060, $e->getErrors()[0]['ErrorNumber']);
        }
    }
}
