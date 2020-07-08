<?php
namespace Budgetlens\PostNLApi\Messages\Requests;

/**
 * Nearest Locations By Geo Request
 *
 * ### Example
 * <code>
 *      $request = $client->locations()->nearestLocationsByGeo();
 *      $request->setLatitude(52.2864669620795);
 *      $request->setLongitude(4.68239055845954);
 *      $request->setCountryCode('NL');
 *      $request->setDeliveryOptions(['PG']);
 *      $response = $request->send();
 *      $locations = $response->getLocations();
 * </code>
 *
 */
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByGeoResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;

class NearestLocationsByGeoRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Latitude
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->getParameter('latitude');
    }

    /**
     * Set Latitude
     * @param float $latitude
     * @return NearestLocationsRequest
     */
    public function setLatitude(float $latitude)
    {
        return $this->setParameter('latitude', $latitude);
    }

    /**
     * Get Longitude
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->getParameter('longitude');
    }

    /**
     * Set Longitude
     * @param float $longitude
     * @return NearestLocationsRequest
     */
    public function setLongitude(float $longitude)
    {
        return $this->setParameter('longitude', $longitude);
    }

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
     * @param string $countryCode
     */
    public function setCountryCode(string $countryCode)
    {
        $this->setParameter('country_code', $countryCode);
    }

    /**
     * Get Delivery Date
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
     * Set Delivery Date
     * @param \DateTime $deliveryDate
     * @return NearestLocationsRequest
     */
    public function setDeliveryDate(\DateTime $deliveryDate)
    {
        return $this->setParameter('delivery_date', $deliveryDate);
    }

    /**
     * Get Opening Time
     * @return string|null
     */
    public function getOpeningTime(): ?string
    {
        $openingTime = $this->getParameter('opening_time');
        return !is_null($openingTime)
            ? $openingTime->format("H:i:s")
            : null;
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
        return $this->getParameter('delivery_options');
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

    /**
     * Get Data
     * @return array
     */
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

    /**
     * Send data
     * @param array $data
     * @return NearestLocationsByGeoResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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
