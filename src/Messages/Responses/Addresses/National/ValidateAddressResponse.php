<?php
namespace Budgetlens\PostNLApi\Messages\Responses\Addresses\National;

use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class ValidateAddressResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * Get Postalcode
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        $data = $this->getData();
        return $data['PostalCode'] ?? null;
    }

    /**
     * Get City
     * @return string|null
     */
    public function getCity(): ?string
    {
        $data = $this->getData();
        return $data['City'] ?? null;
    }

    /**
     * Get Street
     * @return string|null
     */
    public function getStreet(): ?string
    {
        $data = $this->getData();
        return $data['Street'] ?? null;
    }

    /**
     * Get HouseNumber
     * @return int|null
     */
    public function getHouseNumber(): ?int
    {
        $data = $this->getData();
        return $data['HouseNumber'] ?? null;
    }

    /**
     * Get Addition
     * @return string|null
     */
    public function getAddition(): ?string
    {
        $data = $this->getData();
        return $data['Addition'] ?? null;
    }

    /**
     * Get Formatted Address
     * @return string|null
     */
    public function getFormattedAddress(): array
    {
        $data = $this->getData();
        return $data['FormattedAddress'] ?? [];
    }

    public function getData()
    {
        $data = parent::getData();
        return (count($data) > 0) ? $data[0] : [];
    }
}
