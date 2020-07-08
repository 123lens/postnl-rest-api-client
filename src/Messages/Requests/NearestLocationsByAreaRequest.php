<?php
namespace Budgetlens\PostNLApi\Messages\Requests;

/**
 * Nearest Locations By Area Request
 *
 * ### Example
 * <code>
 *      $request = $client->locations()->nearestLocationsByArea();
 *      $request->setLatitudeNorth(52.156439);
 *      $request->setLongitudeWest(5.015643);
 *      $request->setLatitudeSouth(52.017473);
 *      $request->setLongitudeEast(5.065254);
 *      $request->setCountryCode('NL');
 *      $request->setDeliveryOptions(['PG']);
 *      $response = $request->send();
 *      $locations = $response->getLocations();
 * </code>
 *
 */
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByAreaResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsByGeoResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;

class NearestLocationsByAreaRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Latitude North
     * @return float|null
     */
    public function getLatitudeNorth(): ?float
    {
        return $this->getParameter('latitude_north');
    }

    /**
     * Set Latitude North
     * @param float $latitude
     * @return NearestLocationsByGeoRequest
     */
    public function setLatitudeNorth(float $latitude)
    {
        return $this->setParameter('latitude_north', $latitude);
    }

    /**
     * Get Longitude West
     * @return float|null
     */
    public function getLongitudeWest(): ?float
    {
        return $this->getParameter('longitude_west');
    }

    /**
     * Set Longitude West
     * @param float $longitude
     * @return NearestLocationsByGeoRequest
     */
    public function setLongitudeWest(float $longitude)
    {
        return $this->setParameter('longitude_west', $longitude);
    }

    /**
     * Get Latitude South
     * @return float|null
     */
    public function getLatitudeSouth(): ?float
    {
        return $this->getParameter('latitude_south');
    }

    /**
     * Set Latitude South
     * @param float $latitude
     * @return NearestLocationsByGeoRequest
     */
    public function setLatitudeSouth(float $latitude)
    {
        return $this->setParameter('latitude_south', $latitude);
    }

    /**
     * Get Longitude East
     * @return float|null
     */
    public function getLongitudeEast(): ?float
    {
        return $this->getParameter('longitude_east');
    }

    /**
     * Set Longitude East
     * @param float $latitude
     * @return NearestLocationsByGeoRequest
     */
    public function setLongitudeEast(float $longitude)
    {
        return $this->setParameter('longitude_east', $longitude);
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
     * Set Delivery date
     * @param \DateTime $deliveryDate
     * @return NearestLocationsRequest
     */
    public function setDeliveryDate(\DateTime $deliveryDate)
    {
        return $this->setParameter('delivery_date', $deliveryDate);
    }

    /**
     * Get Opening Time
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
            'latitude_north',
            'longitude_west',
            'latitude_south',
            'longitude_east',
            'delivery_options',
            'country_code'
        );

        $data = [
            'LatitudeNorth' => $this->getLatitudeNorth(),
            'LongitudeWest' => $this->getLongitudeWest(),
            'LatitudeSouth' => $this->getLatitudeSouth(),
            'LongitudeEast' => $this->getLongitudeEast(),
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
            '/shipment/v2_1/locations/area',
            [
                'query' => $data
            ]
        );

        return $this->response = new NearestLocationsByAreaResponse($this, $response->getBody()->json());
    }
}
