<?php
namespace Budgetlens\PostNLApi\Entities\Shipment;

/**
 * Amounts Entity
 * Class Amounts
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Intervention\Validation\Rules\Bic;
use Intervention\Validation\Rules\Iban;
use Intervention\Validation\Validator;

class Amounts extends AbstractEntity implements EntityInterface
{
    private $availableAmountTypes = [
        '01', '02', '04', '12'
    ];

    /**
     * 01 = Cash on delivery (COD)
     * 02 = Insured value
     * 04 mandatory for Commercial route China.
     * 12 mandatory for Inco terms DDP Commercial route China.
     * @var string
     */
    public $AmountType;
    /**
     * @var string
     */
    public $AccountName;
    /**
     * @var string
     */
    public $BIC;
    /**
     * @var string
     */
    public $Currency;
    /**
     * @var string
     */
    public $IBAN;

    /**
     * @var string
     */
    public $Reference;
    /**
     * @var string
     */
    public $TransactionNumber;
    /**
     * @var float
     */
    public $Value;

    /**
     * Get Amount Type
     * Amount type. This is a code.
     * Possible values are: 01 = Cash on delivery (COD)
     * 02 = Insured value
     * 04 mandatory for Commercial route China.
     * 12 mandatory for Inco terms DDP Commercial route China.
     * @return string|null
     */
    public function getAmountType(): ?string
    {
        return $this->AmountType ?? null;
    }

    /**
     * Set Amount Type
     * Amount type. This is a code.
     * Possible values are: 01 = Cash on delivery (COD)
     * 02 = Insured value
     * 04 mandatory for Commercial route China.
     * 12 mandatory for Inco terms DDP Commercial route China.
     * @param string $type
     * @return $this
     */
    public function setAmountType(string $type)
    {
        $this->validOption($type, $this->availableAmountTypes);
        $this->AmountType = $type;
        return $this;
    }

    /**
     * Get Account Name
     * Name of bank account owner
     * @return string|null
     */
    public function getAccountName(): ?string
    {
        return $this->AccountName ?? null;
    }

    /**
     * Set Account Name
     * Name of bank account owner
     * @param string $accountName
     * @return $this
     */
    public function setAccountName(string $accountName)
    {
        $this->AccountName = $accountName;
        return $this;
    }

    /**
     * Get BIC
     * BIC number, optional for COD shipments
     * (mandatory for bank account number other than originating in The Netherlands)
     * @return string|null
     */
    public function getBIC(): ?string
    {
        return $this->BIC ?? null;
    }

    /**
     * Set BIC
     * BIC number, optional for COD shipments
     * (mandatory for bank account number other than originating in The Netherlands)
     * @param string $bic
     * @return $this
     */
    public function setBIC(string $bic)
    {
        $validator = new Validator(new Bic);
        if (!$validator->validate($bic)) {
            throw new \InvalidArgumentException("Invalid BIC");
        }
        $this->BIC = $bic;
        return $this;
    }

    /**
     * Get Currency
     * Currency code according ISO 4217. E.g. EUR
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->Currency ?? null;
    }

    /**
     * Set Currency
     * Currency code according ISO 4217. E.g. EUR
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency)
    {
        $this->Currency = $currency;
        return $this;
    }

    /**
     * Get IBAN
     * IBAN bank account number, mandatory for COD shipments. Dutch IBAN numbers are 18 characters
     * @return string|null
     */
    public function getIBAN(): ?string
    {
        return $this->IBAN ?? null;
    }

    /**
     * Set IBAN
     * IBAN bank account number, mandatory for COD shipments. Dutch IBAN numbers are 18 characters
     * @param string $iban
     * @return $this
     */
    public function setIBAN(string $iban)
    {
        // validate iban
        $validator = new Validator(new Iban);
        if (!$validator->validate($iban)) {
            throw new \InvalidArgumentException("Invalid IBAN");
        }
        $this->IBAN = $iban;
        return $this;
    }

    /**
     * Get Reference
     * Personal payment reference
     * @return string
     */
    public function getReference()
    {
        return $this->Reference;
    }

    /**
     * Set Reference
     * Personal payment reference
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference)
    {
        $this->Reference = $reference;
        return $this;
    }

    /**
     * Get Transaction Number
     * Transaction number
     * @return string|null
     */
    public function getTransactionNumber(): ?string
    {
        return $this->TransactionNumber;
    }

    /**
     * Set Transaction Number
     * Transaction number
     * @param string $transactionNumber
     * @return $this
     */
    public function setTransactionNumber(string $transactionNumber)
    {
        $this->TransactionNumber = $transactionNumber;
        return $this;
    }

    /**
     * Get Value
     * Money value in EUR (unless value Currency is specified for another currency).
     * Value format (N6.2): #####0.00 (2 digits behind decimal dot)
     * Mandatory for COD, Insured products (with the exception of certain productcodes with a standard insured amount)
     * and Commercial route China.
     * For COD the Eurosign (€) is always required
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->Value ?? null;
    }

    /**
     * Set Value
     * Money value in EUR (unless value Currency is specified for another currency).
     * Value format (N6.2): #####0.00 (2 digits behind decimal dot)
     * Mandatory for COD, Insured products (with the exception of certain productcodes with a standard insured amount)
     * and Commercial route China.
     * For COD the Eurosign (€) is always required
     * @param float $value
     * @return $this
     */
    public function setValue(float $value)
    {
        $this->Value = $value;
        return $this;
    }
}
