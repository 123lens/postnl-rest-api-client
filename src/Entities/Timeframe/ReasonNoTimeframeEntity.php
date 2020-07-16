<?php
namespace Budgetlens\PostNLApi\Entities\Timeframe;

/**
 * Reason No Time Frame Entity
 * Class OpeningHour
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class ReasonNoTimeframeEntity extends AbstractEntity implements EntityInterface
{
    public $code;
    public $date;
    public $description;
    public $options = [];


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

    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }
    public function getCode(): ?string
    {
        return $this->code;
    }
    public function addOption(string $option)
    {
        $this->options[] = $option;
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
