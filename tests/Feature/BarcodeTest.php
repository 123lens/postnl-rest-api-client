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
    public function generateBarcodeDomestic()
    {
        $request = $this->getClient('Barcode/generateBarcodeDomesticSuccess.json')->barcode()->generateBarcodeDomestic();
        $request->setCustomerCode(getenv('CUSTOMER_CODE'))
            ->setCustomerNumber(getenv('CUSTOMER_NUMBER'));
        $response = $request->send();
        $this->assertInstanceOf(GenerateBarcodeResponse::class, $response);
        $this->assertSame('3STBJG243556367', $response->getBarcode());
    }

    /**
     * @test
     */
    public function generateBarcodeEU()
    {
        $request = $this->getClient('Barcode/generateBarcodeEuSuccess.json')->barcode()->generateBarcodeEu();
        $request->setCustomerCode(getenv('CUSTOMER_CODE'))
            ->setCustomerNumber(getenv('CUSTOMER_NUMBER'));
        $response = $request->send();
        $this->assertInstanceOf(GenerateBarcodeResponse::class, $response);
        $this->assertSame('3STBJG1402522', $response->getBarcode());
    }

    /**
     * @test
     */
    public function generateBarcodeGlobalPack()
    {
        $request = $this->getClient('Barcode/generateBarcodeGlobalPackSuccess.json')->barcode()->generateBarcodeGlobalPack();
        $request->setCustomerCode(getenv('CUSTOMER_CODE'))
            ->setCustomerNumber(getenv('CUSTOMER_NUMBER'))
            ->setType('CD')
            ->setRange(getenv('GLOBAL_PACK_CODE'));
        $response = $request->send();
        $this->assertInstanceOf(GenerateBarcodeResponse::class, $response);
        $this->assertSame('CD630548715NL', $response->getBarcode());
    }

}
