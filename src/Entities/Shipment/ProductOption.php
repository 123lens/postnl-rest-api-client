<?php
namespace Budgetlens\PostNLApi\Entities\Shipment;

/**
 * ProductOption Entity
 * Class ProductOption
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Entities\Shipment\Customs\Item;
use Budgetlens\PostNLApi\Traits\ValidationTrait;

class ProductOption extends AbstractEntity implements EntityInterface
{
    use ValidationTrait;

    public $Characteristic;
    public $Option;

    /**
     * Get Characteristic
     * The characteristic of the ProductOption. Mandatory for some products, please see the Products page
     * @see https://developer.postnl.nl/browse-apis/send-and-track/products/
     * @return string|null
     */
    public function getCharacteristic(): ?string
    {
        return $this->Characteristic;
    }

    /**
     * Set Characteristic
     * The characteristic of the ProductOption. Mandatory for some products, please see the Products page
     * @see https://developer.postnl.nl/browse-apis/send-and-track/products/
     * @param string $characteristic
     * @return $this
     */
    public function setCharacteristic(string $characteristic)
    {
        $this->Characteristic = $characteristic;
        return $this;
    }

    /**
     * Get Option
     * The product option code for this ProductOption. Mandatory for some products, please see the Products page
     * @see https://developer.postnl.nl/browse-apis/send-and-track/products/
     * @return string|null
     */
    public function getOption(): ?string
    {
        return $this->Option;
    }

    /**
     * Set Option
     * The product option code for this ProductOption. Mandatory for some products, please see the Products page
     * @see https://developer.postnl.nl/browse-apis/send-and-track/products/
     * @param string $option
     * @return $this
     */
    public function setOption(string $option)
    {
        $this->Option = $option;
        return $this;
    }
}
