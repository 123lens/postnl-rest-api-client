<?php
namespace Budgetlens\PostNLApi\Messages\Responses\Addresses\Basic;

use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class ValidateAddressResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * Get Status
     * Equals 1 if address exists in range, equals 0 if not
     * @return string|null
     */
    public function getStatus(): ?string
    {
        $data = $this->getData();
        return $data['status'] ?? null;
    }

    /**
     * Get Postalcode
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        $data = $this->getData();
        return $data['postalCode'] ?? null;
    }

    /**
     * Get City
     * @return string|null
     */
    public function getCity(): ?string
    {
        $data = $this->getData();
        return $data['city'] ?? null;
    }

    /**
     * Get Street
     * @return string|null
     */
    public function getStreet(): ?string
    {
        $data = $this->getData();
        return $data['streetName'] ?? null;
    }

    /**
     * Get HouseNumber
     * @return int|null
     */
    public function getHouseNumber(): ?int
    {
        $data = $this->getData();
        return $data['houseNumber'] ?? null;
    }

    /**
     * Get Area code
     * @return string|null
     */
    public function getAreaCode(): ?string
    {
        $data = $this->getData();
        return $data['areaCode'] ?? null;
    }
}
