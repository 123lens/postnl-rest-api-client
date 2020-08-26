<?php
namespace Budgetlens\PostNLApi\Entities\Shipment;

/**
 * ExtraField Entity
 * Class ExtraField
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Entities\Shipment\Customs\Item;
use Budgetlens\PostNLApi\Traits\ValidationTrait;

class ExtraField extends AbstractEntity implements EntityInterface
{
    use ValidationTrait;

    public $Key;
    public $Value;

    /**
     * Get Key
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->Key;
    }

    /**
     * Set Key
     * @param string $key
     * @return $this
     */
    public function setKey(string $key)
    {
        $this->Key = $key;
        return $this;
    }

    /**
     * Get Value
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->Value;
    }

    /**
     * Set Value
     * @param string $value
     * @return $this
     */
    public function setValue(string $value)
    {
        $this->Value = $value;
        return $this;
    }
}
