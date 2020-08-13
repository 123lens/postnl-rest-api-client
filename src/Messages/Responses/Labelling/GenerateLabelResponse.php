<?php
namespace Budgetlens\PostNLApi\Messages\Responses\Laelling;

/**
 * Label Response
 */

use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class GenerateLabelResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * Get Merged Labels
     * @return string
     */
    public function getMergedLabels()
    {
        $data = $this->getData();
        $labels = $data['MergedLabels'] ?? [];
        return $labels;
    }

    public function getShipments()
    {
        $data = $this->getData();
        $shipments = $data['ResponseShipments'] ?? [];
        return $shipments;
    }
}
