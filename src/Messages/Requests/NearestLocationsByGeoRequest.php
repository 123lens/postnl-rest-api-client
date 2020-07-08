<?php
namespace Budgetlens\PostNLApi\Messages\Requests;

/**
 * Nearest Locations Request
 *
 * ### Example
 * <code>
 *      $request = $client->locations()->nearestLocationsByGeo();
 *      $request->setCountryCode('NL')
 *      $request->setPostalcode('1000AA')
 *      $request->setDeliveryOptions(['PG']);
 *      $response = $request->send();
 *      $locations = $response->getLocations();
 * </code>
 *
 */
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;

class NearestLocationsByGeoRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Country Code
     * @return string|null
     */
    public function getLatitude(): ?float
    {
        return $this->getParameter('latitude');
    }

    /**
     * Set Country Code
     * @param string $country
     * @return NearestLocationsRequest
     */
    public function setLatitude(float $latitude)
    {
        return $this->setParameter('latitude', $latitude);
    }

    /**
     * Get Postal code
     * @return string|null
     */
    public function getLongitude(): ?float
    {
        return $this->getParameter('longitude');
    }

    /**
     * Set Postal Code
     * @param string $postalcode
     * @return NearestLocationsRequest
     */
    public function setLongitude(float $longitude)
    {
        return $this->setParameter('longitude', $longitude);
    }

    /**
     * Get City
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->getParameter('country_code');
    }

    /**
     * Set City
     * @param string $city
     */
    public function setCountryCode(string $countryCode)
    {
        $this->setParameter('country_code', $countryCode);
    }

    /**
     * Get Street
     * @return string|null
     */
    public function getDeliveryDate(): ?string
    {
        $deliveryDate = $this->getParameter('delivery_date');
        return !is_null($deliveryDate)
            ? $deliveryDate->format('d-m-Y')
            : null;
    }

    /**
     * Set Street
     * @param string $street
     * @return NearestLocationsRequest
     */
    public function setDeliveryDate(\DateTime $deliveryDate)
    {
        return $this->setParameter('delivery_date', $deliveryDate);
    }

    /**
     * Get House Number
     * @return int|null
     */
    public function getOpeningTime(): ?string
    {
        $openingTime = $this->getParameter('opening_time');
        return !is_null($openingTime)
            ? $openingTime->format("H:i:s")
            : null;
    }

    /**
     * Set House Number
     * @param int $houseNumber
     * @return NearestLocationsRequest
     */
    public function setOpeningTime(\DateTime $openingTime)
    {
        return $this->setParameter('opening_time', $openingTime);
    }

    /**
     * Get Delivery Date (dd-mm-YYYY)
     * @return string|null
     */
    public function getDeliveryOptions(): array
    {
        return $this->getParameter('delivery_options');
    }

    /**
     * Set Delivery Date
     * @param \DateTime $deliveryDate
     * @return NearestLocationsRequest
     */
    public function setDeliveryOptions(array $deliveryOptions)
    {
        return $this->setParameter('delivery_options', $deliveryOptions);
    }

    public function getData(): array
    {
        $this->validate(
            'latitude',
            'longitude',
            'delivery_options',
            'country_code'
        );

        $data = [
            'Latitude' => $this->getLatitude(),
            'Longitude' => $this->getLongitude(),
            'CountryCode' => $this->getCountryCode(),
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
            '/shipment/v2_1/locations/nearest/geocode',
            [
                'query' => $data
            ]
        );
        return $this->response = new NearestLocationsByGeoResponse($this, $response->getBody()->json());
    }
}
