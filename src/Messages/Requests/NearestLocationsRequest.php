<?php
namespace Budgetlens\PostNLApi\Messages\Requests;


use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;

class NearestLocationsRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Country Code
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->getParameter('country_code');
    }

    /**
     * Set Country Code
     * @param string $country
     * @return NearestLocationsRequest
     */
    public function setCountryCode(string $country)
    {
        return $this->setParameter('country_code', $country);
    }

    /**
     * Get Postal code
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->getParameter('postal_code');
    }

    /**
     * Set Postal Code
     * @param string $postalcode
     * @return NearestLocationsRequest
     */
    public function setPostalCode(string $postalcode)
    {
        return $this->setParameter('postal_code', $postalcode);
    }

    /**
     * Get City
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->getParameter('city');
    }

    /**
     * Set City
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->setParameter('city', $city);
    }

    /**
     * Get Street
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->getParameter('street');
    }

    /**
     * Set Street
     * @param string $street
     * @return NearestLocationsRequest
     */
    public function setStreet(string $street)
    {
        return $this->setParameter('street', $street);
    }

    /**
     * Get House Number
     * @return int|null
     */
    public function getHouseNumber(): ?int
    {
        return $this->getParameter('house_number');
    }

    /**
     * Set House Number
     * @param int $houseNumber
     * @return NearestLocationsRequest
     */
    public function setHouseNumber(int $houseNumber)
    {
        return $this->setParameter('house_number', $houseNumber);
    }

    /**
     * Get Delivery Date (dd-mm-YYYY)
     * @return string|null
     */
    public function getDeliveryDate(): ?string
    {
        $date = $this->getParameter('delivery_date');
        return !is_null($date) ? $date->format("d-m-Y") : null;
    }

    /**
     * Set Delivery Date
     * @param \DateTime $deliveryDate
     * @return NearestLocationsRequest
     */
    public function setDeliveryDate(\DateTime $deliveryDate)
    {
        return $this->setParameter('delivery_date', $deliveryDate);
    }

    /**
     * Get Opening Time (hh:ii:ss)
     * @return string|null
     */
    public function getOpeningTime(): ?string
    {
        $time = $this->getParameter('opening_time');
        return !is_null($time) ? $time->format("H:i:s") : null;
    }

    /**
     * Set Opening Time
     * @param \DateTime $openingTime
     * @return NearestLocationsRequest
     */
    public function setOpeningTime(\DateTime $openingTime)
    {
        return $this->setParameter('opening_time', $openingTime);
    }

    /**
     * Get Delivery Options
     * @return array
     */
    public function getDeliveryOptions(): array
    {
        return $this->getParameters('delivery_options');
    }

    /**
     * Set Delivery Options
     * @param array $deliveryOptions
     * @return NearestLocationsRequest
     */
    public function setDeliveryOptions(array $deliveryOptions)
    {
        return $this->setParameter('delivery_options', $deliveryOptions);
    }

    public function getData(): array
    {
        $this->validate(
            'country_code',
            'postal_code',
            'delivery_options'
        );

        $data = [
            'CountryCode' => $this->getCountryCode(),
            'PostalCode' => $this->getPostalCode(),
            'City' => $this->getCity(),
            'Street' => $this->getStreet(),
            'HouseNumber' => $this->getHouseNumber(),
            'DeliveryDate' => $this->getDeliveryDate(),
            'OpeningTime' => $this->getOpeningTime(),
            'DeliveryOptions' => $this->getDeliveryOptions()
        ];
        return array_filter($data);
    }

    public function sendData(array $data = [])
    {
        $response = $this->client->request(
            'GET',
            '/shipment/v2_1/locations/nearest',
            [
                'query' => $data
            ]
        );
        return $this->response = new NearestLocationsResponse($this, $response->getBody()->json());
    }
}
