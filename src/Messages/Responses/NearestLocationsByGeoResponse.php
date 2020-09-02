<?php
namespace Budgetlens\PostNLApi\Messages\Responses;

/**
 * Nearest Locations By Geo Response
 */

use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class NearestLocationsByGeoResponse extends AbstractLocationsResponse implements ResponseInterface
{
    /**
     * Get Return Data
     * @return array|mixed
     */
    public function getData()
    {
        return $this->data['GetLocationsResult']['ResponseLocation'] ?? [];
    }
}
