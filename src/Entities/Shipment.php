<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Shipment Entity
 * Class Shipment
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Entities\Shipment\Address;
use Budgetlens\PostNLApi\Entities\Shipment\Contact;
use Budgetlens\PostNLApi\Entities\Shipment\Dimension;

class Shipment extends AbstractEntity implements EntityInterface
{
    private $Address;
    private $Barcode;
    private $Contacts = [];
    private $DeliveryAddress;
    private $Dimension;
    private $ProductCodeDelivery;

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
     * Get Barcode
     * Barcode of the shipment. This is a unique value
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->Barcode ?? null;
    }

    /**
     * Set Barcode of the shipment. This is a unique value
     * @param string $barcode
     * @return $this
     */
    public function setBarcode(string $barcode)
    {
        $this->Barcode = $barcode;
        return $this;
    }

    /**
     * Get Contacts
     * One or more ContactType elements belonging to a shipment
     * Mandatory in some cases. Please refer to the Guidelines
     * @return array
     */
    public function getContacts(): array
    {
        return $this->Contacts;
    }

    /**
     * Add Contact Option
     * One or more ContactType elements belonging to a shipment
     * Mandatory in some cases. Please refer to the Guidelines
     * @param Contact $contact
     * @return $this
     */
    public function addContact(Contact $contact)
    {
        $this->Contacts[] = $contact;
        return $this;
    }

    /**
     * Get Delivery Address
     * Delivery address specification.
     * This field is mandatory when AddressType on the Address is 09.
     * @return string|null
     */
    public function getDeliveryAddress(): ?string
    {
        return $this->DeliveryAddress ?? null;
    }

    /**
     * Set Delivery Address
     * Delivery address specification.
     * This field is mandatory when AddressType on the Address is 09.
     * @param string $deliveryAddress
     * @return $this
     */
    public function setDeliveryAddress(string $deliveryAddress)
    {
        $this->DeliveryAddress = $deliveryAddress;
        return $this;
    }

    /**
     * Get Dimension
     * Dimension of a shipment.
     * @return Dimension|null
     */
    public function getDimension(): ?Dimension
    {
        return $this->Dimension;
    }

    /**
     * Set Dimension
     * Dimension of a shipment.
     * @param Dimension $dimension
     * @return $this
     */
    public function setDimension(Dimension $dimension)
    {
        $this->Dimension = $dimension;
        return $this;
    }

    /**
     * Get Product Code Delivery
     * @return string|null
     */
    public function getProductCodeDelivery(): ?string
    {
        return $this->ProductCodeDelivery;
    }

    /**
     * Set Product Code Delivery
     * Product code of the shipment
     * @param string $productCodeDelivery
     * @return $this
     */
    public function setProductCodeDelivery(string $productCodeDelivery)
    {
        $this->ProductCodeDelivery = $productCodeDelivery;
        return $this;
    }
}
