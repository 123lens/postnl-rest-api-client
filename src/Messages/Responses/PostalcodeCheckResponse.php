<?php
namespace Budgetlens\PostNLApi\Messages\Responses;

/**
 * Postalcode Check Response
 */

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class PostalcodeCheckResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * Get Return Data
     * @return array|mixed
     */
    public function getData()
    {
        return $this->data[0] ?? [];
    }

    /**
     * Get City
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->getData()['city'] ?? null;
    }

    /**
     * Get Postal Code
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->getData()['postalCode'] ?? null;
    }

    /**
     * Get Street Name
     * @return string|null
     */
    public function getStreetName(): ?string
    {
        return $this->getData()['streetName'] ?? null;
    }

    /**
     * Get House Number
     * @return int|null
     */
    public function getHouseNumber(): ?int
    {
        return $this->getData()['houseNumber'] ?? null;
    }

    /**
     * Get Formatted Address
     * @return array
     */
    public function getFormattedAddress(): array
    {
        return $this->getData()['formattedAddress'] ?? [];
    }
}
