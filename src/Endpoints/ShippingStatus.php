<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Shipping Status Endpoint
 * @see https://developer.postnl.nl/browse-apis/send-and-track/shippingstatus-webservice/
 * Class ShippingStatus
 * @package Budgetlens\PostNLApi\Endpoints
 */

class ShippingStatus extends AbstractEndpoint
{
    /**
     * Generate Shipment with confirm
     * @param array $data
     * @return mixed
     */
    public function barcode(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\ShippingStatus\GenerateStatusByBarcodeRequest',
            $data
        );
    }

    /**
     * Generate Shipment without confirm
     * @param array $data
     * @return mixed
     */
    public function reference(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\ShippingStatus\GenerateStatusByReferenceRequest',
            $data
        );
    }

    public function lookup(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\ShippingStatus\GenerateStatusByKgidRequest',
            $data
        );
    }

    public function signature(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\ShippingStatus\GenerateSignatureStatusByBarcodeRequest',
            $data
        );
    }

    public function shipment(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\ShippingStatus\GenerateUpdatedShipmentsByCustomerNumberRequest',
            $data
        );
    }
}
