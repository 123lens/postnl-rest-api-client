<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Shipment Entity
 * Class Shipment
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Entities\Shipment\Amounts;
use Budgetlens\PostNLApi\Entities\Shipment\Contact;
use Budgetlens\PostNLApi\Entities\Shipment\Customs;
use Budgetlens\PostNLApi\Entities\Shipment\Dimension;
use Budgetlens\PostNLApi\Entities\Shipment\ExtraField;
use Budgetlens\PostNLApi\Entities\Shipment\Group;
use Budgetlens\PostNLApi\Entities\Shipment\HazardousMaterial;
use Budgetlens\PostNLApi\Entities\Shipment\ProductCodes;
use Budgetlens\PostNLApi\Entities\Shipment\ProductOption;

class Shipment extends AbstractEntity implements EntityInterface
{
    public $Addresses = [];
    public $Amounts = [];
    public $Barcode;
    public $CodingText;
    public $CollectionTimeStampStart;
    public $CollectionTimeStampEnd;
    public $Contacts = [];
    public $Content;
    public $CostCenter;
    public $CustomerOrderNumber;
    public $Customs;
    public $DeliveryAddress;
    public $DeliveryDate;
    public $DeliveryTimeStampStart;
    public $DeliveryTimeStampEnd;
    public $Dimension;
    public $DownPartnerBarcode;
    public $DownPartnerID;
    public $DownPartnerLocation;
    public $Groups = [];
    public $HazardousMaterial = [];
    public $IDType;
    public $IDNumber;
    public $IDExpiration;
    public $ProductCodeCollect;
    public $ProductCodeDelivery;
    public $ProductOptions = [];
    public $ReceiverDateOfBirth;
    public $Reference;
    public $ReferenceCollect;
    public $Remark;
    public $ReturnBarcode;
    public $ReturnReference;
    public $TimeslotID;
    public $ExtraFields = [];

    const ID_TYPE_DUTCH_RESIDENCE_DOCUMENT = "01";
    const ID_TYPE_DUTCH_ID = "02";
    const ID_TYPE_DUTCH_PASPORT = "03";
    const ID_TYPE_DUTCH_DRIVING_LICENSE = "04";
    const ID_TYPE_EUROPEAN_ID = "05";
    const ID_TYPE_FOREIGN_ID = "07";

    /**
     * Get Address
     * @return array
     */
    public function getAddresses(): array
    {
        $return = [];
        foreach ($this->Addresses as $address) {
            $return[] = $address->toArray();
        }
        return $return;
    }

    /**
     * Add Address
     * @param Address $address
     * @return $this
     */
    public function addAddress(Address $address)
    {
        $this->Addresses[] = $address;
        return $this;
    }

    /**
     * Get Amounts
     * @return array|null
     */
    public function getAmounts(): ?array
    {
        return count($this->Amounts)
            ? $this->Amounts
            : null;
    }

    /**
     * Add Amount
     * @param Amounts $amount
     * @return $this
     */
    public function addAmount(Amounts $amount)
    {
        $this->Amounts[] = $amount;
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
     * Get Coding Text
     * CodingText used for mailbox parcels. If you are using GenerateLabelWithoutConfirm, please use this value in
     * the Confirming request when confirming the shipment.
     * @return string|null
     */
    public function getCodingText(): ?string
    {
        return $this->CodingText ?? null;
    }

    /**
     * Set Coding Text
     * CodingText used for mailbox parcels. If you are using GenerateLabelWithoutConfirm, please use this value in
     * the Confirming request when confirming the shipment.
     * @param string $codingText
     * @return $this
     */
    public function setCodingText(string $codingText)
    {
        $this->CodingText = $codingText;
        return $this;
    }

    /**
     * Get Collection TimeStamp Start
     * Starting date/time of the collection of the shipment. Format: dd-MM-yyyy hh:mm:ss
     * @return string|null
     */
    public function getCollectionTimeStampStart(): ?string
    {
        if (!is_null($this->CollectionTimeStampStart)) {
            return $this->CollectionTimeStampStart->format('d-m-Y H:i:s');
        }
        return null;
    }

    /**
     * Set Collection TimeStamp Start
     * Starting date/time of the collection of the shipment. Format: dd-MM-yyyy hh:mm:ss
     * @param \DateTime $date
     * @return $this
     */
    public function setCollectionTimeStampStart(\DateTime $date)
    {
        $this->CollectionTimeStampStart = $date;
        return $this;
    }

    /**
     * Get Collection TimeStamp End
     * Ending date/time of the collection of the shipment. Format: dd-MM-yyyy hh:mm:ss
     * @return string|null
     */
    public function getCollectionTimeStampEnd(): ?string
    {
        if (!is_null($this->CollectionTimeStampEnd)) {
            return $this->CollectionTimeStampEnd->format('d-m-Y H:i:s');
        }
        return null;
    }

    /**
     * Set Collection TimeStamp End
     * Ending date/time of the collection of the shipment. Format: dd-MM-yyyy hh:mm:ss
     * @param \DateTime $date
     * @return $this
     */
    public function setCollectionTimeStampEnd(\DateTime $date)
    {
        $this->CollectionTimeStampEnd = $date;
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
        $return = [];
        foreach ($this->Contacts as $contact) {
            $return[] = $contact->toArray();
        }
        return $return;
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
     * Get Content
     * Content of the shipment. Mandatory for Extra@Home shipments
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->Content;
    }

    /**
     * Set Content
     * Content of the shipment. Mandatory for Extra@Home shipments
     * @param string $content
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->Content = $content;
        return $this;
    }

    /**
     * Get Cost Center
     * Cost center of the shipment. This value will appear on your invoice
     * @return string|null
     */
    public function getCostCenter(): ?string
    {
        return $this->CostCenter;
    }

    /**
     * Set Cost Center
     * Cost center of the shipment. This value will appear on your invoice
     * @param string $costCenter
     * @return $this
     */
    public function setCostCenter(string $costCenter)
    {
        $this->CostCenter = $costCenter;
        return $this;
    }

    /**
     * Get Customer Order Number
     * Order number of the customer
     * @return string|null
     */
    private function getCustomerOrderNumber(): ?string
    {
        return $this->CustomerOrderNumber;
    }

    /**
     * Set Customer Order Number
     * Order number of the customer
     * @param string $customerOrderNumber
     * @return $this
     */
    public function setCustomerOrderNumber(string $customerOrderNumber)
    {
        $this->CustomerOrderNumber = $customerOrderNumber;
        return $this;
    }

    /**
     * Get Customs
     * @return Customs|null
     */
    public function getCustoms(): ?Customs
    {
        return $this->Customs;
    }

    /**
     * Set Customs
     * @param Customs $customs
     * @return $this
     */
    public function setCustoms(Customs $customs)
    {
        $this->Customs = $customs;
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
        return $this->DeliveryAddress;
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
     * Get Delivery Date
     * The delivery date of the shipment. We strongly advice to use the DeliveryDate service to get this date when
     * using delivery options like Evening/Morning/Sameday delivery etc. For those products, this field is mandatory
     * (please regard the Guidelines section). Format: dd-MM-yyyy hh:mm:ss
     * @return string|null
     */
    public function getDeliveryDate(): ?string
    {
        return !is_null($this->DeliveryDate)
            ? $this->DeliveryDate->format('d-m-Y H:i:s')
            : null;
    }

    /**
     * Set Delivery Date
     * The delivery date of the shipment. We strongly advice to use the DeliveryDate service to get this date when
     * using delivery options like Evening/Morning/Sameday delivery etc. For those products, this field is mandatory
     * (please regard the Guidelines section). Format: dd-MM-yyyy hh:mm:ss
     * @param \DateTime $date
     * @return $this
     */
    public function setDeliveryDate(\DateTime $date)
    {
        $this->DeliveryDate = $date;
        return $this;
    }

    /**
     * Get Delivery Timestamp Start
     * The delivery date and the specific starting time of the shipment delivery. This can be retrieved from the
     * DeliveryDate webservice using the MyTime delivery option. Format: dd-MM-yyyy hh:mm:ss
     * @return string|null
     */
    public function getDeliveryTimeStampStart(): ?string
    {
        return !is_null($this->DeliveryTimeStampStart)
            ? $this->DeliveryTimeStampStart->format('d-m-Y H:i:s')
            : null;
    }

    /**
     * Set Delivery Timestamp Start
     * The delivery date and the specific starting time of the shipment delivery. This can be retrieved from the
     * DeliveryDate webservice using the MyTime delivery option. Format: dd-MM-yyyy hh:mm:ss
     * @param \DateTime $date
     * @return $this
     */
    public function setDeliveryTimeStampStart(\DateTime $date)
    {
        $this->DeliveryTimeStampStart = $date;
        return $this;
    }

    /**
     * Get Delivery Timestamp End
     * The delivery date and the specific end time of the shipment delivery. This can be retrieved from the
     * DeliveryDate webservice using the MyTime delivery option. Format: dd-MM-yyyy hh:mm:ss
     * @return string|null
     */
    public function getDeliveryTimeStampEnd(): ?string
    {
        return !is_null($this->DeliveryTimeStampEnd)
            ? $this->DeliveryTimeStampEnd->format('d-m-Y H:i:s')
            : null;
    }

    /**
     * Set Delivery Timestamp End
     * The delivery date and the specific end time of the shipment delivery. This can be retrieved from the
     * DeliveryDate webservice using the MyTime delivery option. Format: dd-MM-yyyy hh:mm:ss
     * @param \DateTime $date
     * @return $this
     */
    public function setDeliveryTimeStampEnd(\DateTime $date)
    {
        $this->DeliveryTimeStampEnd = $date;
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
     * Get Down Partner Barcode
     * Barcode of the downstream network partner of PostNL Pakketten
     * @return string|null
     */
    public function getDownPartnerBarcode(): ?string
    {
        return $this->DownPartnerBarcode;
    }

    /**
     * Set Down Partner Barcode
     * Barcode of the downstream network partner of PostNL Pakketten
     * @param string $downpartnerBarcode
     * @return $this
     */
    public function setDownPartnerBarcode(string $downpartnerBarcode)
    {
        $this->DownPartnerBarcode = $downpartnerBarcode;
        return $this;
    }

    /**
     * Get Down Partner ID
     * Identification of the downstream network partner of PostNL Pakketten.
     * @return string|null
     */
    public function getDownPartnerID(): ?string
    {
        return $this->DownPartnerID;
    }

    /**
     * Set Down Partner ID
     * Identification of the downstream network partner of PostNL Pakketten.
     * @param string $downPartnerId
     * @return $this
     */
    public function setDownPartnerID(string $downPartnerId)
    {
        $this->DownPartnerID = $downPartnerId;
        return $this;
    }

    /**
     * Get Down Partner Location
     * Identification of the location of the downstream network partner of PostNL Pakketten.
     * Mandatory for Pickup at PostNl Location Belgium: LD-01
     * @return string|null
     */
    public function getDownPartnerLocation(): ?string
    {
        return $this->DownPartnerLocation;
    }

    /**
     * Set Down Partner Location
     * Identification of the location of the downstream network partner of PostNL Pakketten.
     * Mandatory for Pickup at PostNl Location Belgium: LD-01
     * @param string $downPartnerLocation
     * @return $this
     */
    public function setDownPartnerLocation(string $downPartnerLocation)
    {
        $this->DownPartnerLocation = $downPartnerLocation;
        return $this;
    }

    /**
     * Get Groups
     * List of 0 or more Group types with data, grouping multiple shipments together.
     * Mandatory for multicollo shipments. Please see Guidelines (Multiple shipments) for more information.
     * @return array|null
     */
    protected function getGroups(): ?array
    {
        return count($this->Groups)
            ? $this->Groups
            : null;
    }

    /**
     * Add Group
     * List of 0 or more Group types with data, grouping multiple shipments together.
     * Mandatory for multicollo shipments. Please see Guidelines (Multiple shipments) for more information.
     * @param Group $group
     * @return $this
     */
    public function addGroup(Group $group)
    {
        $this->Groups[] = $group;
        return $this;
    }

    /**
     * Get HazardousMaterial
     * @return array|null
     */

    public function getHazardousMaterial(): ?array
    {
        return count($this->HazardousMaterial)
            ? $this->HazardousMaterial
            : null;
    }

    /**
     * Add Hazardous Material Item
     * @param HazardousMaterial $item
     * @return $this
     */
    public function addHazardousMaterial(HazardousMaterial $item)
    {
        $this->HazardousMaterial[] = $item;
        return $this;
    }

    /**
     * Get ID Type
     * Type of the ID document. Mandatory for ID Check products. See Products for possible values
     * @return string|null
     */
    public function getIDType(): ?string
    {
        return $this->IDType;
    }

    /**
     * Set ID Type
     * Type of the ID document. Mandatory for ID Check products. See Products for possible values
     * @param string $idType
     * @return $this
     */
    public function setIDType(string $idType)
    {
        $this->IDType = $idType;
        return $this;
    }

    /**
     * Get ID Number
     * Document number of the ID document. Mandatory for ID Check products
     * @return string|null
     */
    public function getIDNumber(): ?string
    {
        return $this->IDNumber;
    }

    /**
     * Set ID Number
     * Document number of the ID document. Mandatory for ID Check products
     * @param string $idNumber
     * @return $this
     */
    public function setIDNumber(string $idNumber)
    {
        $this->IDNumber = $idNumber;
        return $this;
    }

    /**
     * Get ID Expiration
     * Expiration date of the ID document. Mandatory for ID Check products
     * @return string|null
     */
    public function getIDExpiration(): ?string
    {
        return !is_null($this->IDExpiration)
            ? $this->IDExpiration->format('d-m-Y')
            : null;
    }

    /**
     * Set ID Expiration
     * Expiration date of the ID document. Mandatory for ID Check products
     * @param \DateTime $date
     * @return $this
     */
    public function setIDExpiration(\DateTime $date)
    {
        $this->IDExpiration = $date;
        return $this;
    }

    /**
     * Get Product Code Collect
     * Second product code of a shipment
     * @return string|null
     */
    public function getProductCodeCollect(): ?string
    {
        return $this->ProductCodeCollect;
    }

    /**
     * Set Product Code Collect
     * Second product code of a shipment
     * @param $productCodeCollect
     * @return $this
     */
    public function setProductCodeCollect($productCodeCollect)
    {
        $this->ProductCodeCollect = $productCodeCollect;
        return $this;
    }

    /**
     * Get Product Code Delivery
     * Product code of the shipment
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
     */
    public function setProductCodeDelivery(string $productCodeDelivery)
    {
        $this->ProductCodeDelivery = $productCodeDelivery;
        return $this;
    }

    /**
     * Add Product Option
     * @param ProductOption $option
     * @return $this
     */
    public function addProductOption(ProductOption $option)
    {
        $this->ProductOptions[] = $option;
        return $this;
    }

    /**
     * Get Product Options
     * Product options for the shipment, mandatory for certain products, see the Products page of this webservice
     * @return array|null
     */
    public function getProductOptions(): ?array
    {
        $return = [];
        foreach ($this->ProductOptions as $option) {
            $return[] = $option->toArray();
        }
        return count($return)
            ? $return
            : null;
    }

    /**
     * Get Receiver Date Of Birth
     * Date of birth. Mandatory for Age check products
     * @return string|null
     */
    public function getReceiverDateOfBirth(): ?string
    {
        return !is_null($this->ReceiverDateOfBirth)
            ? $this->ReceiverDateOfBirth->format('d-m-Y')
            : null;
    }

    /**
     * Set Receiver Date Of Birth
     * Date of birth. Mandatory for Age check products
     * @param \DateTime $date
     * @return $this
     */
    public function setReceiverDateOfBirth(\DateTime $date)
    {
        $this->ReceiverDateOfBirth = $date;
        return $this;
    }

    /**
     * Get Reference
     * Your own reference of the shipment. Mandatory for Extra@Home shipments; for E@H this is used to create your
     * order number, so this should be unique for each request.
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->Reference;
    }

    /**
     * Set Reference
     * Your own reference of the shipment. Mandatory for Extra@Home shipments; for E@H this is used to create your
     * order number, so this should be unique for each request.
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference)
    {
        $this->Reference = $reference;
        return $this;
    }

    /**
     * Get Reference Collect
     * Additional reference of the collect order of the shipment
     * @return string|null
     */
    public function getReferenceCollect(): ?string
    {
        return $this->ReferenceCollect;
    }

    /**
     * Set Reference Collect
     * Additional reference of the collect order of the shipment
     * @param string $referenceCollect
     * @return $this
     */
    public function setReferenceCollect(string $referenceCollect)
    {
        $this->ReferenceCollect = $referenceCollect;
        return $this;
    }

    /**
     * Get Remark
     * Remark of the shipment.
     * @return string|null
     */
    public function getRemark(): ?string
    {
        return $this->Remark;
    }

    /**
     * Set Remark
     * Remark of the shipment.
     * @param string $remark
     * @return $this
     */
    public function setRemark(string $remark)
    {
        $this->Remark = $remark;
        return $this;
    }

    /**
     * Get Return Barcode
     * @return string|null
     */
    public function getReturnBarcode(): ?string
    {
        return $this->ReturnBarcode;
    }

    /**
     * Set Return Barcode
     * @param string $returnBarcode
     * @return $this
     */
    public function setReturnBarcode(string $returnBarcode)
    {
        $this->ReturnBarcode = $returnBarcode;
        return $this;
    }

    /**
     * Get Return Reference
     * Return reference of the shipment
     * @return mixed
     */
    public function getReturnReference()
    {
        return $this->ReturnReference;
    }

    /**
     * Set Return Reference
     * Return reference of the shipment
     * @param string $returnReference
     */
    public function setReturnReference(string $returnReference)
    {
        $this->ReturnReference = $returnReference;
        return $this;
    }

    /**
     * Get Timeslot ID
     * ID of the chosen timeslot as returned by the timeslot webservice
     * @return string|null
     */
    public function getTimeslotID(): ?string
    {
        return $this->TimeslotID;
    }

    /**
     * Set Timeslot ID
     * ID of the chosen timeslot as returned by the timeslot webservice
     * @param string $timeslotId
     * @return $this
     */
    public function setTimeslotID(string $timeslotId)
    {
        $this->TimeslotID = $timeslotId;
        return $this;
    }

    /**
     * Get Extra Fields
     * @return array
     */
    public function getExtraFields(): ?array
    {
        return count($this->ExtraFields)
            ? $this->ExtraFields
            : null;
    }

    /**
     * Add Extra Field
     * @param ExtraField $extra
     */
    public function addExtraFields(ExtraField $extra)
    {
        $this->ExtraFields[] = $extra;
        return $this;
    }
}
