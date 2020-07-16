<?php
namespace Budgetlens\PostNLApi\Messages\Responses\Addresses\International;

use Budgetlens\PostNLApi\Entities\Address\Geo;
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

    /**
     * Get Geo Entity
     * @return Geo|null
     */
    public function getGeo(): ?Geo
    {
        $data = $this->getData();
        if (isset($data['geo'])) {
            $geo = $data['geo'];
            return (new Geo())
                ->setLat((float)$geo['lat'])
                ->setLong((float)$geo['long1'])
                ->setRdx((float)$geo['rdxCoordinate'])
                ->setRdy((float)$geo['rdyCoordinate']);
        }
        return null;
    }

    /**
     * Get Data
     * @return array|mixed
     */
    public function getData()
    {
        $data = parent::getData();
        return (count($data) > 0) ? $data[0] : [];
    }
}
