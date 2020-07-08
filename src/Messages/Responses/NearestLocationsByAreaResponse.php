<?php
namespace Budgetlens\PostNLApi\Messages\Responses;

/**
 * Nearest Locations By Area Response
 */

use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class NearestLocationsByAreaResponse extends AbstractLocationsResponse implements ResponseInterface
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
