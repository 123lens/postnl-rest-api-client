<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Client\Middleware\ErrorResponseException;
use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Customer;
use Budgetlens\PostNLApi\Entities\Shipment;
use Budgetlens\PostNLApi\Messages\Responses\ShippingStatus\ShippingStatusResponse;
use Tests\TestCase;
use Faker\Factory;

class ShippingStatusTest extends TestCase
{
    // mostly used in tests
    const PRODUCT_CODE = "3085";
    const REMARK = "UNIT TEST";

    /**
     * @test
     */
    public function getStatusByBarcode()
    {
        $barcode = '3STBJG243556389';
        $request = $this->getClient('ShippingStatus/GetStatusByBarcodeSuccess.json')->shippingStatus()->barcode();
        $request->setBarcode($barcode);
        $response = $request->send();
        $this->assertInstanceOf(ShippingStatusResponse::class, $response);
        $this->assertIsArray($response->getCurrentStatus());
        $this->assertArrayHasKey('Shipment', $response->getCurrentStatus());
        $this->assertSame('3STBJG243556369', $response->getCurrentStatus()['Shipment']['MainBarcode']);
    }

    /**
     * @test
     */
    public function getStatusByReference()
    {
        $request = $this->getClient('ShippingStatus/GetStatusByReferenceSuccess.json')->shippingStatus()->reference();
        $request->setReferenceId('Reference');
        $request->setCustomerNumber(getenv('CUSTOMER_NUMBER'));
        $request->setCustomerCode(getenv('CUSTOMER_CODE'));
        $response = $request->send();
        $this->assertInstanceOf(ShippingStatusResponse::class, $response);
        $this->assertIsArray($response->getCurrentStatus());
        $this->assertArrayHasKey('Shipment', $response->getCurrentStatus());
        // count shipments
        $this->assertCount(8, $response->getCurrentStatus()['Shipment']);
        $this->assertSame('3STBJG196272025', $response->getCurrentStatus()['Shipment'][0]['MainBarcode']);
    }

    /**
     * @test
     */
    public function getStatusByReferenceWarnings()
    {
        $request = $this->getClient('ShippingStatus/GetStatusByReferenceWarnings.json')->shippingStatus()->reference();
        $request->setReferenceId('ref1234');
        $request->setCustomerNumber(getenv('CUSTOMER_NUMBER'));
        $request->setCustomerCode(getenv('CUSTOMER_CODE'));
        $response = $request->send();
        $this->assertInstanceOf(ShippingStatusResponse::class, $response);
        $this->assertIsArray($response->getWarnings());
        $this->assertCount(1, $response->getWarnings());
        $this->assertSame('2', $response->getWarnings()[0]['Code']);
        $this->assertSame('No shipment found', $response->getWarnings()[0]['Message']);
    }

    /**
     * @test
     */
    public function getStatusByLookup()
    {
        $request = $this->getClient('ShippingStatus/GetStatusByLookupWarnings.json')->shippingStatus()->lookup();
        // no test value for shipments in response, so just test the warnings
        $request->setKgid('ref1234');
        $response = $request->send();
        $this->assertInstanceOf(ShippingStatusResponse::class, $response);
        $this->assertIsArray($response->getWarnings());
        $this->assertCount(1, $response->getWarnings());
        $this->assertSame('2', $response->getWarnings()[0]['Code']);
        $this->assertSame('No shipment found', $response->getWarnings()[0]['Message']);
    }

    /**
     * @test
     */
    public function getStatusSignatureWarning()
    {
        $barcode = '3STBJG243556389';
        $request = $this->getClient('ShippingStatus/GetStatusSignatureWarning.json')->shippingStatus()->signature();
        // no test value for shipments/signature in response, so just test the warnings
        $request->setBarcode($barcode);
        $response = $request->send();
        $this->assertInstanceOf(ShippingStatusResponse::class, $response);
        $this->assertIsArray($response->getWarnings());
        $this->assertCount(1, $response->getWarnings());
        $this->assertSame('2', $response->getWarnings()['Warning']['Code']);
        $this->assertSame('No signature found', $response->getWarnings()['Warning']['Message']);
    }

    /**
     * @test
     */
    public function getUpdatedShipments()
    {
        $request = $this->getClient('ShippingStatus/GetUpdatedShipmentsSuccess.json')->shippingStatus()->shipment();
        $request->setCustomerNumber(getenv('CUSTOMER_NUMBER'));
        $response = $request->send();
        $this->assertInstanceOf(ShippingStatusResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertArrayHasKey('Barcode', $response->getData()[0]);
        $this->assertArrayHasKey('Status', $response->getData()[0]);
        $this->assertSame('2', $response->getData()[0]['Status']['StatusCode']);
    }

    /**
     * @test
     */
    public function getUpdatedShipmentsFilterPeriod()
    {
        $request = $this->getClient('ShippingStatus/GetUpdatedShipmentsFilterPeriodSuccess.json')->shippingStatus()->shipment();
        $request->setCustomerNumber(getenv('CUSTOMER_NUMBER'));
        $request->addPeriod(new \DateTime('2020-08-07'));
        $request->addPeriod(new \DateTime('2020-08-08'));
        $response = $request->send();
        $this->assertInstanceOf(ShippingStatusResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertCount(68, $response->getData());
        $this->assertSame('3STBJG947586457', $response->getData()[0]['Barcode']);
        $this->assertSame('22', $response->getData()[0]['Status']['StatusCode']);
        $this->assertSame('4', $response->getData()[0]['Status']['PhaseCode']);
    }
}
