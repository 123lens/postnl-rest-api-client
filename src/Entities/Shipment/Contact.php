<?php
namespace Budgetlens\PostNLApi\Entities\Shipment;

/**
 * Contact Entity
 * Class Contact
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Traits\ValidationTrait;

class Contact extends AbstractEntity implements EntityInterface
{
    use ValidationTrait;

    private $availableContactTypes = [
        '01'
    ];

    /**
     * Contact Types:
     *  01  Default
     * @var string
     */
    public $ContactType;
    /**
     * @var string
     */
    public $Email;
    /**
     * @var string
     */
    public $SMSNr;
    /**
     * @var string
     */
    public $TelNr;

    /**
     * Get Contact type
     * Type of the contact. This is a code. You can find the possible values at Guidelines
     * @return string|null
     */
    public function getContactType(): ?string
    {
        return $this->ContactType ?? null;
    }

    /**
     * Set Contact Type
     * Type of the contact. This is a code. You can find the possible values at Guidelines
     * @param string $contactType
     * @return $this
     */
    public function setContactType(string $contactType)
    {
        $this->validOption($contactType, $this->availableContactTypes);
        $this->ContactType = $contactType;
        return $this;
    }

    /**
     * Get Email
     * Email address of the contact. Mandatory in some cases. Please see Guidelines
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->Email ?? null;
    }

    /**
     * Set Email
     * Email address of the contact. Mandatory in some cases. Please see Guidelines
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->Email = $email;
        return $this;
    }

    /**
     * Get SMSNr
     * Mobile phone number of the contact. Mandatory in some cases.
     * @return string|null
     */
    public function getSMSNr(): ?string
    {
        return $this->SMSNr ?? null;
    }

    /**
     * Set SMSNr
     * Mobile phone number of the contact. Mandatory in some cases.
     * @param string $smsNumber
     * @return $this
     */
    public function setSMSNr(string $smsNumber)
    {
        $this->SMSNr = $smsNumber;
        return $this;
    }

    /**
     * Get TelNr
     * Phone number of the contact.
     * @return string|null
     */
    public function getTelNr(): ?string
    {
        return $this->TelNr ?? null;
    }

    /**
     * Set TelNr
     * Phone number of the contact.
     * @param string $telNumber
     * @return $this
     */
    public function setTelNr(string $telNumber)
    {
        $this->TelNr = $telNumber;
        return $this;
    }
}
