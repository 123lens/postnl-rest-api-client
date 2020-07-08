<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Opening Hour Entity
 * Class OpeningHour
 * @package Budgetlens\PostNLApi\Entities
 */
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class OpeningHour extends AbstractEntity implements EntityInterface
{
    public $day;
    public $hours;

    /**
     * Get Day
     * @return string|null
     */
    public function getDay(): ?string
    {
        return $this->day ?? null;
    }

    /**
     * Set Day
     * @param string $day
     * @return $this
     */
    public function setDay(string $day)
    {
        $this->day = $day;
        return $this;
    }

    /**
     * Get Hours
     * @return string|null
     */
    public function getHours(): ?string
    {
        return $this->hours ?? null;
    }

    /**
     * Set Hours
     * @param string $hours
     * @return $this
     */
    public function setHours(string $hours)
    {
        $this->hours = $hours;
        return $this;
    }
}
