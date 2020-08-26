<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Customer Entity
 * Class Customer
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class Customer extends AbstractEntity implements EntityInterface
{
    public $Address;
    public $CollectionLocation;
    public $ContactPerson;
    public $CustomerCode;
    public $CustomerNumber;
    public $Email;
    public $Name;

    /**
     * Get Address
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->Address;
    }

    /**
     * Set Address
     * @param Address $address
     * @return $this
     */
    public function setAddress(Address $address)
    {
        $this->Address = $address;
        return $this;
    }

    /**
     * Get Collection Location
     * Code of delivery location at PostNL Pakketten
     * @return string|null
     */
    public function getCollectionLocation(): ?string
    {
        return $this->CollectionLocation ?? null;
    }

    /**
     * Set Collection Location
     * Code of delivery location at PostNL Pakketten
     * @param string $collectionLocation
     * @return $this
     */
    public function setCollectionLocation(string $collectionLocation)
    {
        $this->CollectionLocation = $collectionLocation;
        return $this;
    }

    /**
     * Get Contact Person
     * Name of customer contact person
     * @return string|null
     */
    public function getContactPerson(): ?string
    {
        return $this->ContactPerson ?? null;
    }

    /**
     * Set Contact Person
     * Name of customer contact person
     * @param string $contactPerson
     * @return $this
     */
    public function setContactPerson(string $contactPerson)
    {
        $this->ContactPerson = $contactPerson;
        return $this;
    }

    /**
     * Get Customer Code
     * Customer code as known at PostNL Pakketten
     * @return string|null
     */
    public function getCustomerCode(): ?string
    {
        return $this->CustomerCode ?? null;
    }

    /**
     * Set Customer Code
     * Customer code as known at PostNL Pakketten
     * @param string $customerCode
     * @return $this
     */
    public function setCustomerCode(string $customerCode)
    {
        $this->CustomerCode = $customerCode;
        return $this;
    }

    /**
     * Get Customer Number
     * Customer number as known at PostNL Pakketten
     * @return string|null
     */
    public function getCustomerNumber(): ?string
    {
        return $this->CustomerNumber ?? null;
    }

    /**
     * Set Customer Number
     * Customer number as known at PostNL Pakketten
     * @param string $customerNumber
     * @return $this
     */
    public function setCustomerNumber(string $customerNumber)
    {
        $this->CustomerNumber = $customerNumber;
        return $this;
    }

    /**
     * Get Email
     * E-mail address of customer
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->Email ?? null;
    }

    /**
     * Set Email
     * E-mail address of customer
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->Email = $email;
        return $this;
    }

    /**
     * Get Name
     * Customer name
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->Name ?? null;
    }

    /**
     * Set Name
     * Customer name
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->Name = $name;
        return $this;
    }
}
