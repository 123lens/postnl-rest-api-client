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
    public $from;
    public $to;


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

    /**
     * Get Opening time From
     * @return string|null
     */
    public function getFrom(): ?string
    {
        return $this->from !== ''
            ? $this->from
            : null;
    }

    /**
     * Set Opening time From
     * @param string $from
     * @return $this
     */
    public function setFrom(string $from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Get Opening time To
     * @return string|null
     */
    public function getTo(): ?string
    {
        return $this->to !== ''
            ? $this->to
            : null;
    }

    /**
     * Set Opening time Top
     * @param string $to
     * @return $this
     */
    public function setTo(string $to)
    {
        $this->to = $to;
        return $this;
    }
}
