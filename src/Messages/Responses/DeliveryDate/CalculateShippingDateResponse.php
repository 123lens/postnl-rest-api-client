<?php
namespace Budgetlens\PostNLApi\Messages\Responses\DeliveryDate;

/**
 * Calculate Shipping Date Response
 */

use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class CalculateShippingDateResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * Get Send Date
     * @return \DateTime|null
     * @throws \Exception
     */
    public function getSendDate(): ?\DateTime
    {
        $data = $this->getData();
        return isset($data['SentDate'])
            ? new \DateTime($data['SentDate'])
            : null;
    }
}
