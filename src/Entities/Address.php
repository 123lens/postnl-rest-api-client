<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Address Entity
 * Class Address
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class Address extends AbstractEntity implements EntityInterface
{
    public $City;
    public $Countrycode;
    public $HouseNr;
    public $Remark;
    public $Street;
    public $Zipcode;
    public $CompanyName;

    /**
     * Get City
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city ?? null;
    }

    /**
     * Set City
     * @param string $city
     * @return $this
     */
    public function setCity(string $city)
    {
        $this->City = $city;
        return $this;
    }

    /**
     * Get Country Code
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->Countrycode ?? null;
    }

    /**
     * Set Country Code
     * @param string $country
     * @return $this
     */
    public function setCountryCode(string $country)
    {
        $this->validateLength($country, 2);
        $this->Countrycode = $country;
        return $this;
    }

    /**
     * Get HouseNumber
     * @return int|null
     */
    public function getHouseNumber(): ?int
    {
        return $this->HouseNr ?? null;
    }

    /**
     * Set House Number
     * @param int $number
     * @return $this
     */
    public function setHouseNumber(int $number)
    {
        $this->HouseNr = $number;
        return $this;
    }

    /**
     * Get Remark
     * @return string|null
     */
    public function getRemark(): ?string
    {
        return $this->Remark ?? null;
    }

    /**
     * Set Remark
     * @param string $remark
     * @return $this
     */
    public function setRemark(string $remark)
    {
        $this->Remark = $remark;
        return $this;
    }

    /**
     * Get Street
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->Street ?? null;
    }

    /**
     * Set Street
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->Street = $street;
    }

    /**
     * Get Zipcode
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->Zipcode ?? null;
    }

    /**
     * Set Zipcode
     * @param string $zipcode
     * @return $this
     */
    public function setZipcode(string $zipcode)
    {
        $this->Zipcode = $zipcode;
        return $this;
    }

    /**
     * Get Company Name
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->CompanyName;
    }

    /**
     * Set Company Name
     * @param string $companyName
     * @return $this
     */
    public function setCompanyName(string $companyName)
    {
        $this->CompanyName = $companyName;
        return $this;
    }
}
