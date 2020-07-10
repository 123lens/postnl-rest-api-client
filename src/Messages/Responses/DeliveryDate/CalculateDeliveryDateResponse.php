<?php
namespace Budgetlens\PostNLApi\Messages\Responses\DeliveryDate;

/**
 * Calculate Delivery Date Response
 */

use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class CalculateDeliveryDateResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * Get Delivery Date
     * @return \DateTime|null
     * @throws \Exception
     */
    public function getDeliveryDate(): ?\DateTime
    {
        $data = $this->getData();
        return isset($data['DeliveryDate'])
            ? new \DateTime($data['DeliveryDate'])
            : null;
    }

    /**
     * Get Options
     * @return array
     */
    public function getOptions(): array
    {
        $data = $this->getData();
        $options = $data['Options'] ?? [];
        // no clue why PostNL uses "string" as key.. but get rid of it..
        return array_values($options);
    }
}
