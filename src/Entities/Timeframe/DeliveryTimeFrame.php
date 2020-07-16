<?php
namespace Budgetlens\PostNLApi\Entities\Timeframe;

/**
 * Delivery Time Frame Entity
 * Class OpeningHour
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Entities\TimeFrame;

class DeliveryTimeFrame extends AbstractEntity implements EntityInterface
{
    public $date;
    public $timeframes = [];

    /**
     * Set Date
     *
     * @param \DateTime $date
     * @return $this
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get Date
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function addTimeframe(TimeFrame $timeframe)
    {
        $this->timeframes[] = $timeframe;
        return $this;
    }

    public function getTimeframes(): array
    {
        return $this->timeframes;
    }
}
