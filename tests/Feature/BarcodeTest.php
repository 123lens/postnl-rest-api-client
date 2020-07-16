<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Entities\Address\Geo;
use Budgetlens\PostNLApi\Messages\Responses\Addresses\Geo\AddressCheckResponse;
use Budgetlens\PostNLApi\Messages\Responses\Addresses\National\ValidateAddressResponse;
use Budgetlens\PostNLApi\Messages\Responses\Barcode\GenerateBarcodeResponse;
use Tests\TestCase;

class BarcodeTest extends TestCase
{
    /**
     * @test
     */
    public function generateBarcode()
    {
        $request = $this->getClient('Barcode/generateBarcodeSuccess.json')->barcode()->generateBarcode();
        $request->setCustomerCode(getenv('CUSTOMER_CODE'))
            ->setCustomerNumber(getenv('CUSTOMER_NUMBER'))
            ->setType('3S');
        $response = $request->send();
        $this->assertInstanceOf(GenerateBarcodeResponse::class, $response);
        $this->assertSame('3STBJG214842', $response->getBarcode());
    }
}
