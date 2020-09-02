<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Delivery Date Option Entity
 * Class DeliveryOption
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class DeliveryDateOption extends AbstractEntity implements EntityInterface
{
    /**
     * @var \DateTime
     */
    public $deliveryDate;
    /**
     * @var array
     */
    public $timeframe = [];

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    /**
     * Get Delivery Date
     * @return \DateTime|null
     */
    public function getDeliveryDate(): ?\DateTime
    {
        return $this->deliveryDate;
    }

    /**
     * Set Delivery Date
     * @param \DateTime $date
     * @return $this
     */
    public function setDeliveryDate(\DateTime $date)
    {
        $this->deliveryDate = $date;
        return $this;
    }

    /**
     * Get Timeframe
     * @return array
     */
    public function getTimeframe(): array
    {
        return is_array($this->timeframe)
            ? $this->timeframe
            : [];
    }

    /**
     * Set Timeframe
     * @param array $timeframe
     * @return $this
     */
    public function setTimeframe(array $timeframe)
    {
        $this->timeframe = $timeframe;
        return $this;
    }
}
