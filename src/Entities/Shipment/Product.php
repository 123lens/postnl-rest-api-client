<?php
namespace Budgetlens\PostNLApi\Entities\Shipment;

/**
 * Product Entity
 * Class ProductOption
 * @package Budgetlens\PostNLApi\Entities
 */

class Product
{
    /**
     * @var string
     */
    private $productCode;
    /**
     * @var string
     */
    private $label;
    /**
     * @var array
     */
    private $countryLimitation = [];
    /**
     * @var array
     */
    private $options = [];
    /**
     * @var array
     */
    private $characteristics = [];

    public function __construct(
        $productCode,
        string $label,
        array $countryLimitation = [],
        array $options = []
    ) {
        $this->productCode = $productCode;
        $this->label = $label;
        $this->countryLimitation = $countryLimitation;
        if (count($options) > 0) {
            $this->parseOptions($options);
        }
    }

    /**
     * Get Product Code
     * @return string|null
     */
    public function getProductCode(): ?string
    {
        return $this->productCode;
    }

    /**
     * Get Label
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Get Country Limitations
     * @return array
     */
    public function getCountryLimitation(): array
    {
        return $this->countryLimitation;
    }

    /**
     * Get Options (such as 'avond levering', 'cod' etc)
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Get Characteristics
     * @return array
     */
    public function getCharacteristics(): array
    {
        return $this->characteristics;
    }

    /**
     * Parse options
     * @param array $options
     */
    private function parseOptions(array $options = [])
    {
        $this->options = $options;
    }
}
