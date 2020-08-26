<?php
namespace Budgetlens\PostNLApi\Messages\Responses\Labelling;

/**
 * Confirm Response
 */

use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class ConfirmResponse extends AbstractResponse implements ResponseInterface
{
    public function getResponseShipments()
    {
        $data = $this->getData();
        $shipments = $data['ResponseShipments'] ?? [];
        return $shipments;
    }
}
