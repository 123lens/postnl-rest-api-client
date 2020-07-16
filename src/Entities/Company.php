<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Company Entity
 * Class Location
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class Company extends AbstractEntity implements EntityInterface
{
    public $companyName;
    public $kvkNumber;
    public $postnlKey;
    public $branchNumber;
    public $companyPhoneNumber;
    public $companyMobilePhoneNumber;
    public $branchStreetName;
    public $branchHouseNumber;
    public $branceHouseNumberAddition;
    public $branchPostalCode;
    public $branchCity;
    public $mailingStreetName;
    public $mailingHouseNumber;
    public $mailingHouseNumberAddition;
    public $mailingPostalCode;
    public $mailingCity;
    public $legalName;
    public $tradeNames;

    /**
     * Get Companyname
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName ?? null;
    }

    /**
     * Set Companyname
     * @param string $company
     */
    public function setCompanyName(string $company)
    {
        $this->companyName = $company;
        return $this;
    }

    /**
     * Get Kvk Number
     * @return string|null
     */
    public function getKvkNumber(): ?string
    {
        return $this->kvkNumber;
    }

    /**
     * Set Kvk Number
     * @param string $kvk
     * @return $this
     */
    public function setKvkNumber(string $kvk)
    {
        $this->kvkNumber = $kvk;
        return $this;
    }

    /**
     * Get PostNL Key
     * @return string|null
     */
    public function getPostnlKey(): ?string
    {
        return $this->postnlKey;
    }

    /**
     * Set PostNL Key
     * @param string $key
     * @return $this
     */
    public function setPostnlKey(string $key)
    {
        $this->postnlKey = $key;
        return $this;
    }

    /**
     * Get Branch Number
     * @return string|null
     */
    public function getBranchNumber(): ?string
    {
        return $this->branchNumber;
    }

    /**
     * Set Branch Number
     * @param string $number
     * @return $this
     */
    public function setBranchNumber(string $number)
    {
        $this->branchNumber = $number;
        return $this;
    }

    /**
     * Get Company Phonenumber
     * @return string|null
     */
    public function getCompanyPhoneNumber(): ?string
    {
        return $this->companyPhoneNumber;
    }

    /**
     * Set Company Phonenumber
     * @param string $number
     * @return $this
     */
    public function setCompanyPhoneNumber(string $number)
    {
        $this->companyPhoneNumber = $number;
        return $this;
    }

    /**
     * Get Company Mobilenumber
     * @return string|null
     */
    public function getCompanyMobilePhoneNumber(): ?string
    {
        return $this->companyMobilePhoneNumber;
    }

    /**
     * Set Company Mobilenumber
     * @param string $number
     * @return $this
     */
    public function setCompanyMobilePhoneNumber(string $number)
    {
        $this->companyMobilePhoneNumber = $number;
        return $this;
    }

    /**
     * Get Branche Streetname
     * @return string|null
     */
    public function getBranchStreetName(): ?string
    {
        return $this->branchStreetName;
    }

    /**
     * Set branche Streetname
     * @param string $name
     * @return $this
     */
    public function setBranchStreetName(string $name)
    {
        $this->branchStreetName = $name;
        return $this;
    }

    /**
     * Get Branch House Number
     * @return int|null
     */
    public function getBranchHouseNumber(): ?int
    {
        return $this->branchHouseNumber;
    }

    /**
     * Set Branch House Number
     * @param int $number
     * @return $this
     */
    public function setBranchHouseNumber(int $number)
    {
        $this->branchHouseNumber = $number;
        return $this;
    }

    /**
     * Get Branch House Number Addition
     * @return string|null
     */
    public function getBranceHouseNumberAddition(): ?string
    {
        return $this->branceHouseNumberAddition;
    }

    /**
     * Set Branch House NUmber Addition
     * @param string $addition
     * @return $this
     */
    public function setBranceHouseNumberAddition(string $addition)
    {
        $this->branceHouseNumberAddition = $addition;
        return $this;
    }

    /**
     * Get Branch Postal Code
     * @return string|null
     */
    public function getBranchPostalCode(): ?string
    {
        return $this->branchPostalCode;
    }

    /**
     * Set branch Postal Code
     * @param string $postalCode
     * @return $this
     */
    public function setBranchPostalCode(string $postalCode)
    {
        $this->branchPostalCode = $postalCode;
        return $this;
    }

    /**
     * Get Branch City
     * @return string|null
     */
    public function getBranchCity(): ?string
    {
        return $this->branchCity;
    }

    /**
     * Set Branch City
     * @param string $city
     * @return $this
     */
    public function setBranchCity(string $city)
    {
        $this->branchCity = $city;
        return $this;
    }

    /**
     * Get Mailing Street Name
     * @return string|null
     */
    public function getMailingStreetName(): ?string
    {
        return $this->mailingStreetName;
    }

    /**
     * Set Mailing Street Name
     * @param string $street
     * @return $this
     */
    public function setMailingStreetName(string $street)
    {
        $this->mailingStreetName = $street;
        return $this;
    }

    /**
     * Get Mailing House Number
     * @return int|null
     */
    public function getMailingHouseNumber(): ?int
    {
        return $this->mailingHouseNumber;
    }

    /**
     * Set Mailing House Number
     * @param int $number
     * @return $this
     */
    public function setMailingHouseNumber(int $number)
    {
        $this->mailingHouseNumber = $number;
        return $this;
    }

    /**
     * Get Mailing House Number Addition
     * @return string|null
     */
    public function getMailingHouseNumberAddition(): ?string
    {
        return $this->mailingHouseNumberAddition;
    }

    /**
     * Set Mailing House Number Addition
     * @param string $addition
     * @return $this
     */
    public function setMailingHouseNumberAddition(string $addition)
    {
        $this->mailingHouseNumberAddition = $addition;
        return $this;
    }

    /**
     * Get Mailing Postal Code
     * @return string|null
     */
    public function getMailingPostalCode(): ?string
    {
        return $this->mailingPostalCode;
    }

    /**
     * Set Mailing Postal Code
     * @param string $postalCode
     * @return $this
     */
    public function setMailingPostalCode(string $postalCode)
    {
        $this->mailingPostalCode = $postalCode;
        return $this;
    }

    /**
     * Get Mailing City
     * @return string|null
     */
    public function getMailingCity(): ?string
    {
        return $this->mailingCity;
    }

    /**
     * Set Mailing City
     * @param string $city
     * @return $this
     */
    public function setMailingCity(string $city)
    {
        $this->mailingCity = $city;
        return $this;
    }

    /**
     * Get Legal Name
     * @return string|null
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    /**
     * Set Legal Name
     * @param string $legalName
     * @return $this
     */
    public function setLegalName(string $legalName)
    {
        $this->legalName = $legalName;
        return $this;
    }

    /**
     * Get TradeName
     * @return string|null
     */
    public function getTradeNames(): ?array
    {
        return $this->tradeNames;
    }

    /**
     * Set TradeName
     * @param string $tradeName
     * @return $this
     */
    public function setTradeNames(array $tradeName = [])
    {
        $this->tradeNames = $tradeName;
        return $this;
    }
}
