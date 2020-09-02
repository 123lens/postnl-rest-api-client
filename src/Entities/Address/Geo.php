<?php
namespace Budgetlens\PostNLApi\Entities\Address;

/**
 * Geo Entity
 * Class Location
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class Geo extends AbstractEntity implements EntityInterface
{
    public $lat;
    public $long1;
    public $rdxCoordinate;
    public $rdyCoordinate;

    /**
     * Get Latitude
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * Set Latitude
     * @param float $lat
     * @return $this
     */
    public function setLat(float $lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * Get Longitude
     * @return float|null
     */
    public function getLong(): ?float
    {
        return $this->long1;
    }

    /**
     * Set Longitude
     * @param float $long
     * @return $this
     */
    public function setLong(float $long)
    {
        $this->long1 = $long;
        return $this;
    }

    /**
     * Get Rdx Coordinate
     * @return float|null
     */
    public function getRdx(): ?float
    {
        return $this->rdxCoordinate;
    }

    /**
     * Set Rdx Coordinate
     * @param float $rdx
     * @return $this
     */
    public function setRdx(float $rdx)
    {
        $this->rdxCoordinate = $rdx;
        return $this;
    }

    /**
     * Get Rdy Coordinate
     * @return float|null
     */
    public function getRdy(): ?float
    {
        return $this->rdyCoordinate;
    }

    /**
     * Set Rdy Coordinate
     * @param float $rdy
     * @return $this
     */
    public function setRdy(float $rdy)
    {
        $this->rdyCoordinate = $rdy;
        return $this;
    }
}
