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
     * Generate Barcode
     * @param array $data
     * @return mixed
     */
    public function generateBarcode(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Barcode\generateBarcodeRequest',
            $data
        );
    }
}
