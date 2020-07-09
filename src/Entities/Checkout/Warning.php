<?php
namespace Budgetlens\PostNLApi\Entities\Checkout;

/**
 * Warning Entity
 * Class Address
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class Warning extends \Budgetlens\PostNLApi\Entities\Warning implements EntityInterface
{
    /**
     * @var \DateTime
     */
    public $deliveryDate;
    /**
     * @var array
     */
    public $options = [];


    /**
     * Get Delivery Date
     * Deliverydate that triggered the warning
     * @return \DateTime|null
     */
    public function getDeliveryDate(): ?\DateTime
    {
        return $this->deliveryDate;
    }

    /**
     * Set Delivery Date
     * Deliverydate that triggered the warning
     * @param \DateTime $date
     * @return $this
     */
    public function setDeliveryDate(\DateTime $date)
    {
        $this->deliveryDate = $date;
        return $this;
    }

    /**
     * Get Options
     * Array of options. Delivery option that triggered the warning
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Set Options
     * Array of options. Delivery option that triggered the warning
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }
}
