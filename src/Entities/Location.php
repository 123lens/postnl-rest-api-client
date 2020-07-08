<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Location Entity
 * Class Location
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class Location extends AbstractEntity implements EntityInterface
{
    public $Distance;
    public $Latitude;
    public $LocationCode;
    public $Longitude;
    public $Name;
    public $PartnerName;
    public $RetailNetworkID;
    public $Saleschannel;
    public $TerminalType;
    private $address;
    private $openingHours;
    private $deliveryOptions;

    /**
     * Get Distance (in meters)
     * @return int|null
     */
    public function getDistance(): ?int
    {
        return $this->Distance ?? null;
    }

    /**
     * Set Distance
     * @param int $distance
     */
    public function setDistance(int $distance)
    {
        $this->Distance = $distance;
    }
    /**
     * Get Latitude
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->Latitude ?? null;
    }

    /**
     * Set Latitude
     * @param float $latitude
     * @return $this
     */
    public function setLatitude(float $latitude)
    {
        $this->Latitude = $latitude;
        return $this;
    }

    /**
     * Get Location Code
     * @return string|null
     */
    public function getLocationCode(): ?string
    {
        return $this->LocationCode ?? null;
    }

    /**
     * Set Location Code
     * @param string $code
     * @return $this
     */
    public function setLocationCode(string $code)
    {
        $this->LocationCode = $code;
        return $this;
    }

    /**
     * Get Longitude
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->Longitude ?? null;
    }

    /**
     * Set Longitude
     * @param float $longitude
     * @return $this
     */
    public function setLongitude(float $longitude)
    {
        $this->Longitude = $longitude;
        return $this;
    }

    /**
     * Get Name
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->Name ?? null;
    }

    /**
     * Set Name
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->Name = $name;
        return $this;
    }

    /**
     * Get Partner Name
     * @return string|null
     */
    public function getPartnerName(): ?string
    {
        return $this->PartnerName ?? null;
    }

    /**
     * Set Partner Name
     * @param string $name
     * @return $this
     */
    public function setPartnerName(string $name)
    {
        $this->PartnerName = $name;
        return $this;
    }

    /**
     * Get Retail Network ID
     * @return string|null
     */
    public function getRetailNetworkID(): ?string
    {
        return $this->RetailNetworkID ?? null;
    }

    /**
     * Set Retail Network ID
     * @param string $id
     * @return $this
     */
    public function setRetailNetworkID(string $id)
    {
        $this->RetailNetworkID = $id;
        return $this;
    }

    /**
     * Get Sales Channel
     * @return string|null
     */
    public function getSalesChannel(): ?string
    {
        return $this->Saleschannel ?? null;
    }

    /**
     * Set Sales Channel
     * @param string $channel
     * @return $this
     */
    public function setSalesChannel(string $channel)
    {
        $this->Saleschannel = $channel;
        return $this;
    }

    /**
     * Get Terminal Type
     * @return string|null
     */
    public function getTerminalType(): ?string
    {
        return $this->TerminalType ?? null;
    }

    /**
     * Set Terminal Type
     * @param string $type
     */
    public function setTerminalType(string $type)
    {
        $this->TerminalType = $type;
    }

    /**
     * Get Address
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address ?? null;
    }

    /**
     * Set Address
     * @param Address $address
     * @return $this
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get Opening Hours
     * @return array
     */
    public function getOpeningHours(): array
    {
        return $this->openingHours ?? [];
    }

    /**
     * Set Opening Hours
     * @param array $openingHours
     * @return $this
     */
    public function setOpeningHours(array $openingHours)
    {
        $this->openingHours = $openingHours;
        return $this;
    }

    /**
     * Get Delivery Options
     * @return array
     */
    public function getDeliveryOptions(): array
    {
        return $this->deliveryOptions ?? [];
    }

    /**
     * Set Delivery Options
     * @param array $options
     * @return $this
     */
    public function setDeliveryOptions(array $options)
    {
        $this->deliveryOptions = $options;
        return $this;
    }
}
