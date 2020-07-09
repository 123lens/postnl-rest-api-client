<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Delivery Time Frame Entity
 * Class OpeningHour
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class TimeFrame extends AbstractEntity implements EntityInterface
{
    public $from;
    public $to;
    public $options;
    public $shippingDate;
    /**
     * Get From
     * Format hh:mm:ss
     * @return string|null
     */
    public function getFrom(): ?string
    {
        return $this->from ?? null;
    }

    /**
     * Set From
     * Format hh:mm:ss
     * @param string $from
     * @return $this
     */
    public function setFrom(string $from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Get To
     * Format hh:mm:ss
     * @return string|null
     */
    public function getTo(): ?string
    {
        return $this->to ?? null;
    }

    /**
     * Set To
     * Format hh:mm:ss
     * @param string $to
     * @return $this
     */
    public function setTo(string $to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * Get Options
     * The delivery options applicable to the timeframe information. See Guidelines for possible values.
     * @return array
     */
    public function getOptions(): array
    {
        return is_array($this->options)
            ? $this->options
            : [];
    }

    /**
     * Set Options
     * The delivery options applicable to the timeframe information. See Guidelines for possible values.
     * @see https://developer.postnl.nl/browse-apis/checkout/checkout-api/documentation/
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Get Shipping date.
     * The date when you need to deliver the shipment to PostNL to ensure the expected delivery date is achieved
     * @see https://developer.postnl.nl/browse-apis/checkout/checkout-api/documentation/
     * @return string|null
     */
    public function getShippingDate(): ?string
    {
        return !is_null($this->shippingDate)
            ? $this->shippingDate->format("Y-m-d")
            : null;
    }

    /**
     * Get Shipping Date
     * The date when you need to deliver the shipment to PostNL to ensure the expected delivery date is achieved
     * @param \DateTime|null $date
     * @return $this
     */
    public function setShippingDate(?\DateTime $date = null)
    {
        $this->shippingDate = $date;
        return $this;
    }
}
