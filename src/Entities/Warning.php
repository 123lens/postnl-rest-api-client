<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Warning Entity
 * Class Location
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class Warning extends AbstractEntity implements EntityInterface
{
    /**
     * @var string
     */
    public $Code;
    /**
     * @var string
     */
    public $Description;

    /**
     * Get Code
     * Warning code (for a possible list of warnings, see the generic error codes page)
     * @see https://developer.postnl.nl/browse-apis/checkout/checkout-api/documentation/
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->Code;
    }

    /**
     * Set Code
     * Warning code (for a possible list of warnings, see the generic error codes page)
     * @see https://developer.postnl.nl/browse-apis/checkout/checkout-api/documentation/
     * @param string $code
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->Code = $code;
        return $this;
    }

    /**
     * Get Description
     * Warning description (for a possible list of warnings, see the generic error codes page)
     * @see https://developer.postnl.nl/browse-apis/checkout/checkout-api/documentation/
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->Description;
    }

    /**
     * Set Description
     * Warning description (for a possible list of warnings, see the generic error codes page)
     * @see https://developer.postnl.nl/browse-apis/checkout/checkout-api/documentation/
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->Description = $description;
        return $this;
    }
}
