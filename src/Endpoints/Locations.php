<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Locations Endpoint
 * @see https://developer.postnl.nl/browse-apis/delivery-options/
 * Class Addresses
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Locations extends AbstractEndpoint
{
    /**
     * Get Nearest Locations
     * @param array $data
     * @return mixed
     */
    public function nearestLocations(array $data = [])
    {
        return $this->createRequest('Budgetlens\PostNLApi\Messages\Requests\NearestLocationsRequest');
    }


}
