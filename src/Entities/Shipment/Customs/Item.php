<?php
namespace Budgetlens\PostNLApi\Entities\Shipment\Customs;

/**
 * Customs Item Entity
 * Class Contact
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Traits\ValidationTrait;

class Item extends AbstractEntity implements EntityInterface
{
    use ValidationTrait;

    private $EAN;
    private $ProductURL;
    private $Quantity;
    private $Weight;
    private $Value;
    private $HSTariffNr;
    private $CountryOfOrigin;

    /**
     * Get Eancode
     * A unique code for a product. Together with HS number this is mandatory for product code 4992.
     * @return string|null
     */
    public function getEAN(): ?string
    {
        return $this->EAN;
    }

    /**
     * Set Eancode
     * A unique code for a product. Together with HS number this is mandatory for product code 4992.
     * @param string $eancode
     * @return $this
     */
    public function setEAN(string $eancode)
    {
        $this->EAN = $eancode;
        return $this;
    }

    /**
     * Get Product URL
     * Webshop URL of the product which is being shipped. Mandatory for product code 4992
     * @return string|null
     */
    public function getProductURL(): ?string
    {
        return $this->ProductURL;
    }

    /**
     * Set Product URL
     * Webshop URL of the product which is being shipped. Mandatory for product code 4992
     * @param string $productUrl
     * @return $this
     */
    public function setProductURL(string $productUrl)
    {
        $this->ProductURL = $productUrl;
        return $this;
    }

    /**
     * Get Quantity
     * Quantity of items in description
     * @return int
     */
    public function getQuantity(): int
    {
        return (int)$this->Quantity;
    }

    /**
     * Set Quantity
     * Quantity of items in description
     * @param int $quantity
     * @return $this
     */
    public function setQuantity(int $quantity)
    {
        $this->Quantity = $quantity;
        return $this;
    }

    /**
     * Get Weight
     * Net weight of goods in gram(gr)
     * @return int
     */
    public function getWeight(): int
    {
        return (int)$this->Weight;
    }

    /**
     * Set Weight
     * Net weight of goods in gram(gr)
     * @param int $weight
     * @return $this
     */
    public function setWeight(int $weight)
    {
        $this->Weight = $weight;
        return $this;
    }

    /**
     * Get Value
     * Commercial (customs) value of goods.
     * @return float|null
     */
    public function getValue(): ?float
    {
        if ($this->Value > 0) {
            return number_format($this->Value / 100, 2, ".", ",");
        }
        return null;
    }

    /**
     * Set Value (in cents)
     * Commercial (customs) value of goods.
     * @param int $value
     * @return $this
     */
    public function setValue(int $value)
    {
        $this->Value = $value;
        return $this;
    }

    /**
     * Get Hs Tarif Number
     * First 6 numbers of Harmonized System Code
     * @return string|null
     */
    public function getHSTariffNr(): ?string
    {
        return $this->HSTariffNr;
    }

    /**
     * Set Hs Tarif Number
     * First 6 numbers of Harmonized System Code
     * @param string $tarif
     * @return $this
     */
    public function setHSTariffNr(string $tarif)
    {
        $this->HSTariffNr = $tarif;
        return $this;
    }

    /**
     * Get Country Of Origin
     * Origin country code
     * @return string|null
     */
    public function getCountryOfOrigin(): ?string
    {
        return $this->CountryOfOrigin;
    }

    /**
     * Set Country Of Origin
     * Origin country code
     * @param string $country
     * @return $this
     */
    public function setCountryOfOrigin(string $country)
    {
        $this->CountryOfOrigin = $country;
        return $this;
    }
}
