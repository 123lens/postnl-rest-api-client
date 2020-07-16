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

    /**
     * Set Code
     * @param string $code
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get Code
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Add Option
     * @param string $option
     * @return $this
     */
    public function addOption(string $option)
    {
        $this->options[] = $option;
        return $this;
    }

    /**
     * Get Options
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Set Options
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Get Description
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set Description
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }
}
