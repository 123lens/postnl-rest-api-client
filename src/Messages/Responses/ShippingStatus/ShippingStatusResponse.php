<?php
namespace Budgetlens\PostNLApi\Messages\Responses\ShippingStatus;

/**
 * Generate Shipment Response
 */

use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class ShippingStatusResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * Get Current Status
     * @return array
     */
    public function getCurrentStatus(): array
    {
        $data = $this->getData();
        $currentStatus = $data['CurrentStatus'] ?? [];
        return $currentStatus;
    }

    /**
     * Get Warnings
     * @return array
     */
    public function getWarnings(): array
    {
        $data = $this->getData();
        return $data['Warnings'] ?? [];
    }
}
