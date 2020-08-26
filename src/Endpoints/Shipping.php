<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Shipping Endpoint
 * @see https://developer.postnl.nl/browse-apis/send-and-track/shipping-webservice/
 * Class Shipping
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Shipping extends AbstractEndpoint
{
    /**
     * Generate Shipment with confirm
     * @param array $data
     * @return mixed
     */
    public function generateShipment(array $data = [])
    {
        $data = array_merge($data, [
            'confirm' => true
        ]);

        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Shipping\GenerateShipmentRequest',
            $data
        );
    }

    /**
     * Generate Shipment without confirm
     * @param array $data
     * @return mixed
     */
    public function generateShipmentWithoutConfirm(array $data = [])
    {
        $data = array_merge($data, [
            'confirm' => false
        ]);

        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Shipping\GenerateShipmentRequest',
            $data
        );
    }
}
