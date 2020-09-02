<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Pickup Option Entity
 * Class Location
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class PickupOption extends AbstractEntity implements EntityInterface
{
    public $pickupDate;
    public $shippingDate;
    public $locations = [];
    public $option;

    /**
     * Get Pickup date
     * @return DateTime|null
     */
    public function getPickupDate(): ?\DateTime
    {
        return $this->pickupDate;
    }

    /**
     * Set Pickup Date
     * @param DateTime $date
     * @return $this
     */
    public function setPickupDate(\DateTime $date)
    {
        $this->pickupDate = $date;
        return $this;
    }

    /**
     * Get Shipping date
     * @return DateTime|null
     */
    public function getShippingDate(): ?\DateTime
    {
        return $this->shippingDate;
    }

    /**
     * Set Shipping Date
     * @param \DateTime $date
     * @return $this
     */
    public function setShippingDate(\DateTime $date)
    {
        $this->shippingDate = $date;
        return $this;
    }

    /**
     * Get Locations
     * @return array
     */
    public function getLocations(): array
    {
        return $this->locations;
    }

    /**
     * Add Location
     * @param Location $location
     * @return $this
     */
    public function addLocation(Location $location)
    {
        $this->locations[] = $location;
        return $this;
    }

    /**
     * Get Option
     * @return string|null
     */
    public function getOption(): ?string
    {
        return $this->option;
    }

    /**
     * Set Option
     * @param string $option
     * @return $this
     */
    public function setOption(string $option)
    {
        $this->option = $option;
        return $this;
    }
}
