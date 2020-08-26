<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Confirming Endpoint
 * @see https://developer.postnl.nl/browse-apis/send-and-track/confirming-webservice/
 * Class Confirming
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Confirming extends AbstractEndpoint
{
    /**
     * Generate Barcode Global Pack (EPS) Shipments
     * @param array $data
     * @return mixed
     */
    public function confirm(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Labelling\ConfirmRequest',
            $data
        );
    }
}
