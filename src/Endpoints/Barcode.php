<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Barcode Endpoint
 * @see https://developer.postnl.nl/browse-apis/send-and-track/barcode-webservice/
 * Class Barcode
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Barcode extends AbstractEndpoint
{
    /**
     * Generate Barcode Domestic (Dutch Shipments)
     * @param array $data
     * @return mixed
     */
    public function generateBarcodeDomestic(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Barcode\GenerateBarcodeDomesticRequest',
            $data
        );
    }

    /**
     * Generate Barcode EU Shipments
     * @param array $data
     * @return mixed
     */
    public function generateBarcodeEu(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Barcode\GenerateBarcodeEuRequest',
            $data
        );
    }

    /**
     * Generate Barcode Global Pack (EPS) Shipments
     * @param array $data
     * @return mixed
     */
    public function generateBarcodeGlobalPack(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Barcode\GenerateBarcodeGlobalPackRequest',
            $data
        );
    }
}
