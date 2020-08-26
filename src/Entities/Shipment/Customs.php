<?php
namespace Budgetlens\PostNLApi\Entities\Shipment;

/**
 * Customs Entity
 * Class Contact
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Entities\Shipment\Customs\Item;
use Budgetlens\PostNLApi\Traits\ValidationTrait;

class Customs extends AbstractEntity implements EntityInterface
{
    use ValidationTrait;

    const TYPE_GIFT = "Gift";
    const TYPE_DOCUMENTS = "Documents";
    const TYPE_COMMERCIAL_GOODS = "Commercial Goods";
    const TYPE_COMMERCIAL_SAMPLE = "Commerical Sample";
    const TYPE_RETURNED_GOODS = "Returned Goods";

    private $availableContactTypes = [
        '01'
    ];

    public $Certificate;
    public $CertificateNr;
    public $License;
    public $LicenseNr;
    public $Invoice;
    public $InvoiceNr;
    public $HandleAsNonDeliverable;
    public $Currency;
    public $ShipmentType;
    public $TrustedShipperID;
    public $ImporterReferenceCode;
    public $TransactionCode;
    public $TransactionDescription;
    public $Content = [];

    /**
     * Get Certificate
     * At least one of the three types Certificate, Invoice or License is mandatory for Commercial
     * Goods,Commercial Sample and Returned Goods
     * @return bool
     */
    public function getCertificate(): bool
    {
        return (bool)$this->Certificate;
    }

    /**
     * Set Certificate
     * At least one of the three types Certificate, Invoice or License is mandatory for Commercial
     * Goods,Commercial Sample and Returned Goods
     * @param bool $flag
     * @return $this
     */
    public function setCertificate(bool $flag)
    {
        $this->Certificate = $flag;
        return $this;
    }

    /**
     * Get Certificate Number
     * Mandatory when Certificate is true.
     * @return string|null
     */
    public function getCertificateNr(): ?string
    {
        return $this->CertificateNr;
    }

    /**
     * Set Certificate Number
     * Mandatory when Certificate is true.
     * @param string $certificateNumber
     * @return $this
     */
    public function setCertificateNr(string $certificateNumber)
    {
        $this->CertificateNr = $certificateNumber;
        return $this;
    }

    /**
     * Get License
     * At least one of the three types Certificate, Invoice or License is mandatory for Commercial
     * Goods,Commercial Sample and Returned Goods
     * @return bool
     */
    public function getLicense(): bool
    {
        return (bool)$this->License;
    }

    /**
     * Set License
     * At least one of the three types Certificate, Invoice or License is mandatory for Commercial
     * Goods,Commercial Sample and Returned Goods
     * @param bool $flag
     * @return $this
     */
    public function setLicense(bool $flag)
    {
        $this->License = $flag;
        return $this;
    }

    /**
     * Get License Number
     * Mandatory when License is true.
     * @return string|null
     */
    public function getLicenseNr(): ?string
    {
        return $this->LicenseNr;
    }

    /**
     * Set License Number
     * Mandatory when License is true.
     * @param string $licenseNumber
     * @return $this
     */
    public function setLicenseNr(string $licenseNumber)
    {
        $this->LicenseNr = $licenseNumber;
        return $this;
    }

    /**
     * Get Invoice
     * At least one of the three types Certificate, Invoice or License is mandatory for Commercial
     * Goods,Commercial Sample and Returned Goods
     * @return bool
     */
    public function getInvoice(): bool
    {
        return (bool)$this->Invoice;
    }

    /**
     * Set Invoice
     * At least one of the three types Certificate, Invoice or License is mandatory for Commercial
     * Goods,Commercial Sample and Returned Goods
     * @param bool $flag
     * @return $this
     */
    public function setInvoice(bool $flag)
    {
        $this->Invoice = $flag;
        return $this;
    }

    /**
     * Get Invoice Number
     * Mandatory when Invoice is true
     * @return string|null
     */
    public function getInvoiceNr(): ?string
    {
        return $this->InvoiceNr;
    }

    /**
     * Set Invoice Number
     * Mandatory when Invoice is true
     * @param string $invoiceNumber
     * @return $this
     */
    public function setInvoiceNr(string $invoiceNumber)
    {
        $this->InvoiceNr = $invoiceNumber;
        return $this;
    }

    /**
     * Get Handle As Non Deliverable
     * Determines what to do when the shipment cannot be delivered the first time
     * (if this is set to true,the shipment will be returned after the first failed attempt)
     * @return bool
     */
    public function getHandleAsNonDeliverable(): bool
    {
        return (bool)$this->HandleAsNonDeliverable;
    }

    /**
     * Set Handle As None Deliverable
     * Determines what to do when the shipment cannot be delivered the first time
     * (if this is set to true,the shipment will be returned after the first failed attempt)
     * @param bool $flag
     * @return $this
     */
    public function setHandleAsNonDeliverable(bool $flag)
    {
        $this->HandleAsNonDeliverable = $flag;
        return $this;
    }

    /**
     * Get Currency
     * Currency code,only EUR and USS are allowed
     * @default EUR
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return !is_null($this->Currency)
            ? $this->Currency
            : "EUR";
    }

    /**
     * Set Currency
     * Currency code,only EUR and USS are allowed
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency)
    {
        if (!in_array($currency, ['EUR', 'USS'])) {
            throw new \InvalidArgumentException("Only 'EUR' and 'USS' are allowed");
        }
        $this->Currency = $currency;
        return $this;
    }

    /**
     * Get Shipment Type
     * Type of shipment,possible values: Gift,Documents,Commercial Goods,Commercial Sample,Returned Goods
     * @return string|null
     */
    public function getShipmentType(): ?string
    {
        return $this->ShipmentType;
    }

    /**
     * Set Shipment Type
     * Type of shipment,possible values: Gift,Documents,Commercial Goods,Commercial Sample,Returned Goods
     * @param string $shipmentType
     * @return $this
     */
    public function setShipmentType(string $shipmentType)
    {
        $this->ShipmentType = $shipmentType;
        return $this;
    }

    /**
     * Get Trusted Shipper ID
     * Trusted shipper ID; Mandatory for US shipments
     * @return string|null
     */
    public function getTrustedShipperID(): ?string
    {
        return $this->TrustedShipperID;
    }

    /**
     * Set Trusted Shipper ID
     * Trusted shipper ID; Mandatory for US shipments
     * @param string $trustedShipperId
     * @return $this
     */
    public function setTrustedShipperID(string $trustedShipperId)
    {
        $this->TrustedShipperID = $trustedShipperId;
        return $this;
    }

    /**
     * Get Importer Reference Code
     * Importer reference code; Mandatory for US shipments
     * @return string|null
     */
    public function getImporterReferenceCode(): ?string
    {
        return $this->ImporterReferenceCode;
    }

    /**
     * Set Importer Reference Code
     * Importer reference code; Mandatory for US shipments
     * @param string $importerReferenceCode
     * @return $this
     */
    public function setImporterReferenceCode(string $importerReferenceCode)
    {
        $this->ImporterReferenceCode = $importerReferenceCode;
        return $this;
    }

    /**
     * Get Transaction Code
     * Transaction code; Mandatory for US shipments
     * @return string|null
     */
    public function getTransactionCode(): ?string
    {
        return $this->TransactionCode;
    }

    /**
     * Set Transaction Code
     * Transaction code; Mandatory for US shipments
     * @param string $transactionCode
     * @return $this
     */
    public function setTransactionCode(string $transactionCode)
    {
        $this->TransactionCode = $transactionCode;
        return $this;
    }

    /**
     * Get Transaction Description
     * Transaction description; Mandatory for US shipments
     * @return string|null
     */
    public function getTransactionDescription(): ?string
    {
        return $this->TransactionDescription;
    }

    /**
     * Set Transaction Description
     * Transaction description; Mandatory for US shipments
     * @param string $transactionDescription
     * @return $this
     */
    public function setTransactionDescription(string $transactionDescription)
    {
        $this->TransactionDescription = $transactionDescription;
        return $this;
    }

    /**
     * Add Content Item
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item)
    {
        $this->Content[] = $item;
        return $this;
    }

    /**
     * Get Content
     * @return array
     */
    public function getContent(): array
    {
        return $this->Content;
    }
}
