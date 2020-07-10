<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Deliverydate Endpoint
 * @see https://developer.postnl.nl/browse-apis/delivery-options/deliverydate-webservice/
 * Class Addresses
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Deliverydate extends AbstractEndpoint
{
    /**
     * Calculate delivery date
     * @param array $data
     * @return mixed
     */
    public function calculateDeliveryDate(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\DeliveryDate\CalculateDeliveryDateRequest',
            $data
        );
    }

    /**
     * Calculate shipping date
     * @param array $data
     * @return mixed
     */
    public function calculateShippingDate(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\DeliveryDate\CalculateShippingDateRequest',
            $data
        );
    }
}
