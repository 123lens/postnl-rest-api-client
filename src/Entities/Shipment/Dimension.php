<?php
namespace Budgetlens\PostNLApi\Entities\Shipment;

/**
 * Dimension Entity
 * Class Dimension
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class Dimension extends AbstractEntity implements EntityInterface
{
    /**
     * @var int
     */
    private $Height;
    /**
     * @var int
     */
    private $Length;
    /**
     * @var int
     */
    private $Volume;
    /**
     * @var int
     */
    private $Weight;
    /**
     * @var int
     */
    private $Width;

    /**
     * Get Height
     * Height of the shipment in milimeters (mm).
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->Height ?? 0;
    }

    /**
     * Set Height
     * Height of the shipment in milimeters (mm).
     * @param int $height
     * @return $this
     */
    public function setHeight(int $height)
    {
        $this->Height = $height;
        return $this;
    }

    /**
     * Get Length
     * Length of the shipment in milimeters (mm).
     * @return int|null
     */
    public function getLength(): ?int
    {
        return $this->Length ?? null;
    }

    /**
     * Set Length
     * Length of the shipment in milimeters (mm).
     * @param int $length
     * @return $this
     */
    public function setLength(int $length)
    {
        $this->Length = $length;
        return $this;
    }

    /**
     * Get Volume
     * Volume of the shipment in centimeters (cm3).
     * Mandatory for E@H-products
     * @return int|null
     */
    public function getVolume(): ?int
    {
        return $this->Volume ?? null;
    }

    /**
     * Set Volume
     * Volume of the shipment in centimeters (cm3).
     * Mandatory for E@H-products
     * @param int $volume
     * @return $this
     */
    public function setVolume(int $volume)
    {
        $this->Volume = $volume;
        return $this;
    }

    /**
     * Get Weight
     * Weight of the shipment in grams
     * Approximate weight suffices
     * @return int|null
     */
    public function getWeight(): ?int
    {
        return $this->Weight ?? null;
    }

    /**
     * Set Weight
     * Weight of the shipment in grams
     * Approximate weight suffices
     * @param int $weight
     * @return $this
     */
    public function setWeight(int $weight)
    {
        $this->Weight = $weight;
        return $this;
    }

    /**
     * Get Width
     * Width of the shipment in milimeters (mm).
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->Width ?? null;
    }

    /**
     * Set Width
     * Width of the shipment in milimeters (mm).
     * @param int $width
     * @return $this
     */
    public function setWidth(int $width)
    {
        $this->Width = $width;
        return $this;
    }
}
