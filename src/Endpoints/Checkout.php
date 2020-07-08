<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Checkout Endpoint
 * @see https://developer.postnl.nl/browse-apis/checkout/
 * Class Addresses
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Checkout extends AbstractEndpoint
{
    /**
     * Postalcode Check
     * @param array $data
     * @return mixed
     */
    public function postalcodeCheck(array $data = [])
    {
        return $this->createRequest('Budgetlens\PostNLApi\Messages\Requests\PostalcodeCheckRequest', $data);
    }
}
