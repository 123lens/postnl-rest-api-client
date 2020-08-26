<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Address Entity
 * Class Address
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Traits\ValidationTrait;

class Address extends AbstractEntity implements EntityInterface
{
    use ValidationTrait;

    const RECEIVER = "01";
    const SENDER = "02";
    const ALTERNATIVE_SENDER = "03";
    const COLLECTION_ADDRESS = "04";
    const RETURN_ADDRESS = "08";
    const DELIVERY_ADDRES = "09";

    const DEFAULT_COUNTRY = "NL";

    private $availableAddressTypes = [
        '01', '02', '03', '04', '08', '09'
    ];

    /**
     * Address Types:
     *  01  Receiver
     *  02  Sender
     *  03  Alternative sender address
     *  04  Collection address
     *  08  Return address*
     *  09  Delivery address (for use with Pick up at PostNL location)
     * @var string
     */
    public $AddressType;
    /**
     * @var string
     */
    public $Area;
    /**
     * @var string
     */
    public $Buildingname;
    /**
     * @var string
     */
    public $City;
    /**
     * @var string
     */
    public $CompanyName;
    /**
     * @var string
     */
    public $Countrycode;
    /**
     * @var string
     */
    public $Department;
    /**
     * @var string
     */
    public $Doorcode;
    /**
     * @var string
     */
    public $FirstName;
    /**
     * @var string
     */
    public $Floor;
    /**
     * @var int
     */
    public $HouseNr;
    /**
     * @var string
     */
    public $HouseNrExt;
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $Region;
    /**
     * @var string
     */
    public $Remark;
    /**
     * @var string
     */
    public $Street;
    /**
     * @var string - combination of street, housenumber + ext, only available for NL, BE, DE
     *              If this var is used, don't use single fields: Street, HouseNr, HouseNrExt
     */
    public $StreetHouseNrExt;
    /**
     * @var string
     */
    public $Zipcode;


    /**
     * Get Address type
     * Type of the address. This is a code. You can find the possible values at Guidelines
     * @return string|null
     */
    public function getAddressType(): ?string
    {
        return $this->AddressType ?? null;
    }

    /**
     * Set Address Type
     * Type of the address. This is a code. You can find the possible values at Guidelines
     * @param string $addressType
     * @return $this
     */
    public function setAddressType(string $addressType)
    {
        $this->validOption($addressType, $this->availableAddressTypes);
        $this->AddressType = $addressType;
        return $this;
    }

    /**
     * Get Area
     * Area of the address
     * @return string|null
     */
    public function getArea(): ?string
    {
        return $this->Area ?? null;
    }

    /**
     * Set Area
     * Area of the address
     * @param string $area
     * @return $this
     */
    public function setArea(string $area)
    {
        $this->Area = $area;
        return $this;
    }

    /**
     * Get Building Name
     * Building name of the address
     * @return string|null
     */
    public function getBuildingname(): ?string
    {
        return $this->Buildingname ?? null;
    }

    /**
     * Set Building Name
     * Building name of the address
     * @param string $buildingName
     * @return $this
     */
    public function setBuildingname(string $buildingName)
    {
        $this->Buildingname = $buildingName;
        return $this;
    }

    /**
     * Get City
     * City of the address
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city ?? null;
    }

    /**
     * Set City
     * City of the address
     * @param string $city
     * @return $this
     */
    public function setCity(string $city)
    {
        $this->City = $city;
        return $this;
    }

    /**
     * Get Companyname
     * This field has a dependency with the field Name. One of both fields must be filled mandatory; using both
     * fields is also allowed. Mandatory when AddressType is 09.
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->CompanyName;
    }

    /**
     * Set Companyname
     * This field has a dependency with the field Name. One of both fields must be filled mandatory; using both
     * fields is also allowed. Mandatory when AddressType is 09.
     * @param string $companyName
     * @return $this
     */
    public function setCompanyName(string $companyName)
    {
        $this->CompanyName = $companyName;
        return $this;
    }

    /**
     * Get Country Code
     * The ISO2 country codes
     * Default "NL"
     * @return string
     */
    public function getCountryCode(): string
    {
        return !is_null($this->Countrycode)
            ? $this->Countrycode
            : self::DEFAULT_COUNTRY;
    }

    /**
     * Set Country Code
     * The ISO2 country codes
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
     * Get Department
     * Send to specific department of a company.
     * @return string|null
     */
    public function getDepartment(): ?string
    {
        return $this->Department;
    }

    /**
     * Set Department
     * Send to specific department of a company.
     * @param string $department
     * @return $this
     */
    public function setDepartment(string $department)
    {
        $this->Department = $department;
        return $this;
    }

    /**
     * Get Doorcode
     * Door code of address
     * @return string|null
     */
    public function getDoorcode(): ?string
    {
        return $this->Doorcode;
    }

    /**
     * Set Doorcode
     * Door code of address
     * @param string $doorCode
     * @return $this
     */
    public function setDoorcode(string $doorCode)
    {
        $this->Doorcode = $doorCode;
        return $this;
    }

    /**
     * Get Firstname
     * Remark: please add FirstName and Name (lastname) of the receiver to improve the parcel tracking
     * experience of your customer.
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    /**
     * Set Firstname
     * Remark: please add FirstName and Name (lastname) of the receiver to improve the parcel tracking
     * experience of your customer.
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName)
    {
        $this->FirstName = $firstName;
        return $this;
    }

    /**
     * Get Floor
     * Send to specific floor of a company.
     * @return string|null
     */
    public function getFloor(): ?string
    {
        return $this->Floor;
    }

    /**
     * Set Floor
     * Send to specific floor of a company.
     * @param string $floor
     * @return $this
     */
    public function setFloor(string $floor)
    {
        $this->Floor = $floor;
        return $this;
    }

    /**
     * Get HouseNumber
     * Mandatory for shipments to Benelux.
     * Max. length is 5 characters (only for Benelux addresses).
     * For Benelux addresses, this field should always be numeric.
     * @return int|null
     */
    public function getHouseNr(): ?int
    {
        return $this->HouseNr ?? null;
    }

    /**
     * Set House Number
     * Mandatory for shipments to Benelux.
     * Max. length is 5 characters (only for Benelux addresses).
     * For Benelux addresses, this field should always be numeric.
     * @param int $number
     * @return $this
     */
    public function setHouseNr(int $number)
    {
        $this->HouseNr = $number;
        return $this;
    }

    /**
     * Get House Nr Ext
     * House number extension
     * @return string|null
     */
    public function getHouseNrExt(): ?string
    {
        return $this->HouseNrExt;
    }

    /**
     * Set House Nr Ext
     * House number extension
     * @param string $houseNrext
     * @return $this
     */
    public function setHouseNrExt(string $houseNrext)
    {
        $this->HouseNrExt = $houseNrext;
        return $this;
    }

    /**
     * Get Last Name
     * Last name of person. This field has a dependency with the field CompanyName. One of both fields must be
     * filled mandatory; using both fields is also allowed. Remark: please add FirstName and Name (lastname) of the
     * receiver to improve the parcel tracking experience of your customer.
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->Name;
    }

    /**
     * Set Last Name
     * Last name of person. This field has a dependency with the field CompanyName. One of both fields must be
     * filled mandatory; using both fields is also allowed. Remark: please add FirstName and Name (lastname) of the
     * receiver to improve the parcel tracking experience of your customer.
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->Name = $name;
        return $this;
    }

    /**
     * Get Region
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->Region;
    }

    /**
     * Set Region
     * @param string $region
     * @return $this
     */
    public function setRegion(string $region)
    {
        $this->Region = $region;
        return $this;
    }

    /**
     * Get Remark
     * Remark of the shipment
     * @return string|null
     */
    public function getRemark(): ?string
    {
        return $this->Remark ?? null;
    }

    /**
     * Set Remark
     * Remark of the shipment
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
     * This field has a dependency with the field StreetHouseNrExt.
     * One of both fields must be filled mandatory; using both fields is also allowed.
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->Street ?? null;
    }

    /**
     * Set Street
     * This field has a dependency with the field StreetHouseNrExt.
     * One of both fields must be filled mandatory; using both fields is also allowed.
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->Street = $street;
        return $this;
    }

    /**
     * Get Street + House number + Ext
     * Combination of Street, HouseNr and HouseNrExt.
     * The field StreetHouseNrExt is only usable for locations in NL, BE and DE.
     * Please see Guidelines for the explanation.
     * @return string|null
     */
    public function getStreetHouseNrExt(): ?string
    {
        return $this->StreetHouseNrExt ?? null;
    }

    /**
     * Set Street + House number + Ext
     * Combination of Street, HouseNr and HouseNrExt.
     * The field StreetHouseNrExt is only usable for locations in NL, BE and DE.
     * Please see Guidelines for the explanation.
     * @param string $streetHouseNrExt
     * @return $this
     */
    public function setStreetHouseNrExt(string $streetHouseNrExt)
    {
        $this->StreetHouseNrExt = $streetHouseNrExt;
        return $this;
    }
    /**
     * Get Zipcode
     * Zipcode of the address. Mandatory for shipments to Benelux
     * Max length (NL) 6 characters, (BE;LU) 4 numeric characters.
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->Zipcode ?? null;
    }

    /**
     * Set Zipcode
     * Zipcode of the address. Mandatory for shipments to Benelux
     * Max length (NL) 6 characters, (BE;LU) 4 numeric characters.
     * @param string $zipcode
     * @return $this
     */
    public function setZipcode(string $zipcode)
    {
        $this->Zipcode = str_replace(" ", "", $zipcode);
        return $this;
    }
}
