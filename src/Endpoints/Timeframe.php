<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Timeframe Endpoint
 * @see https://developer.postnl.nl/browse-apis/delivery-options/timeframe-webservice/
 * Class Addresses
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Timeframe extends AbstractEndpoint
{
    /**
     * Calculate Timeframes
     * @param array $data
     * @return mixed
     */
    public function calculateTimeframes(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Timeframes\CalculateTimeframesRequest',
            $data
        );
    }
}
