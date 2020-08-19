<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Labelling Endpoint
 * @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/
 * Class Labelling
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Labelling extends AbstractEndpoint
{
    /**
     * Generate Barcode Global Pack (EPS) Shipments
     * @param array $data
     * @return mixed
     */
    public function generateLabel(array $data = [])
    {
        $data = array_merge($data, [
            'confirm' => true
        ]);

        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Labelling\GenerateLabelRequest',
            $data
        );
    }

    public function generateLabelWithoutConfirm(array $data = [])
    {
        $data = array_merge($data, [
            'confirm' => false
        ]);

        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Labelling\GenerateLabelRequest',
            $data
        );
    }
}
