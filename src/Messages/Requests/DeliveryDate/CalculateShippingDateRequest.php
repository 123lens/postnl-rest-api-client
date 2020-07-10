<?php
namespace Budgetlens\PostNLApi\Messages\Requests\DeliveryDate;

/**
 * Postalcode Check Request
 *
 * ### Example
 * <code>
 *      $request = $client->checkout()->postalcodeCheck();
 *      $request->setPostalcode('1000AA')
 *      $request->setHouseNumber(1);
 *      $response = $request->send();
 *      $data = $response->getData();
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\AbstractRequest;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\DeliveryDate\CalculateDeliveryDateResponse;
use Budgetlens\PostNLApi\Messages\Responses\DeliveryDate\CalculateShippingDateResponse;

class CalculateShippingDateRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    private $availableOptions = [
        'Daytime', 'Evening', 'Morning', 'Noon', 'Sunday', 'Sameday', 'Afternoon', 'MyTime'
    ];

    /**
     * Get Delivery Date
     * @return \DateTime|null
     */
    public function getDeliveryDate(): ?\DateTime
    {
        return $this->getParameter('delivery_date');
    }

    /**
     * Set Delivery Date
     *
     * @param \DateTime $date
     * @return CalculateShippingDateRequest
     */
    public function setDeliveryDate(\DateTime $date)
    {
        return $this->setParameter('delivery_date', $date);
    }

    /**
     * Get Shipping Duration
     * The duration it takes for the shipment to be delivered to PostNL in days. A value of 1 means that the
     * parcel will be delivered to PostNL on the same day as the date specified in ShippingDate. A value of 2
     * means the parcel will arrive at PostNL a day later etc.
     * @return int|null
     */
    public function getShippingDuration(): ?int
    {
        return $this->getParameter('shipping_duration');
    }

    /**
     * Set Shipping Duration
     * The duration it takes for the shipment to be delivered to PostNL in days. A value of 1 means that the
     * parcel will be delivered to PostNL on the same day as the date specified in ShippingDate. A value of 2
     * means the parcel will arrive at PostNL a day later etc.
     * @param int $duration
     */
    public function setShippingDuration(int $duration)
    {
        return $this->setParameter('shipping_duration', $duration);
    }

    /**
     * Get Postal Code
     * Zipcode of the address
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->getParameter('postal_code');
    }

    /**
     * Set Postal Code
     * Zipcode of the address
     * @param string $postalCode
     * @return CalculateDeliveryDateRequest
     */
    public function setPostalCode(string $postalCode)
    {
        return $this->setParameter('postal_code', $postalCode);
    }

    /**
     * Get Country Code
     * The ISO2 country codes
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->getParameter('country_code');
    }

    /**
     * Set Country Code
     * The ISO2 country codes
     * @param string $countryCode
     * @return CalculateDeliveryDateRequest
     */
    public function setCountryCode(string $countryCode)
    {
        $this->validOption($countryCode, ['NL', 'BE']);
        return $this->setParameter('country_code', $countryCode);
    }

    /**
     * Get Origin Country Code
     * Origin country of the shipment
     * Default NL
     * Possible values NL and BE.
     * @return string|null
     */
    public function getOriginCountryCode(): ?string
    {
        return $this->getParameter('origin_country_code');
    }

    /**
     * Set Origin Country Code
     * Origin country of the shipment
     * Default NL
     * Possible values NL and BE.
     * @param string $countryCode
     * @return CalculateDeliveryDateRequest
     */
    public function setOriginCountryCode(string $countryCode = 'NL')
    {
        $this->validOption($countryCode, ['NL', 'BE']);
        return $this->setParameter('origin_country_code', $countryCode);
    }

    /**
     * Get City
     * City of the address
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->getParameter('city');
    }

    /**
     * Set City
     * City of the address
     * @param string $city
     * @return CalculateDeliveryDateRequest
     */
    public function setCity(string $city)
    {
        return $this->setParameter('city', $city);
    }

    /**
     * Get Street
     * The street name of the delivery address.
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->getParameter('street');
    }

    /**
     * Set Street
     * The street name of the delivery address.
     * @param string $street
     * @return CalculateDeliveryDateRequest
     */
    public function setStreet(string $street)
    {
        return $this->setParameter('street', $street);
    }

    /**
     * Get House Number
     * The house number of the delivery address
     * @return int|null
     */
    public function getHouseNumber(): ?int
    {
        return $this->getParameter('house_number');
    }

    /**
     * Set House Number
     * The house number of the delivery address
     * @param int $houseNumber
     * @return CalculateDeliveryDateRequest
     */
    public function setHouseNumber(int $houseNumber)
    {
        return $this->setParameter('house_number', $houseNumber);
    }

    /**
     * Get House Number Ext
     * House number extension
     * @return string|null
     */
    public function getHouseNrExt(): ?string
    {
        return $this->getParameter('house_number_ext');
    }

    /**
     * Set House Number Ext
     * House number extension
     * @param string $houseNumberExt
     * @return CalculateDeliveryDateRequest
     */
    public function setHouseNrExt(string $houseNumberExt)
    {
        return $this->setParameter('house_number_ext', $houseNumberExt);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'delivery_date',
            'shipping_duration',
            'postal_code'
        );

        $data = [
            'DeliveryDate' => $this->getDeliveryDate()->format('d-m-Y'),
            'ShippingDuration' => $this->getShippingDuration(),
            'PostalCode' => $this->getPostalCode(),
            'CountryCode' => $this->getCountryCode(),
            'OriginCountryCode' => $this->getOriginCountryCode(),
            'City' => $this->getCity(),
            'Street' => $this->getStreet(),
            'HouseNumber' => $this->getHouseNumber(),
            'HouseNrExt' => $this->getHouseNrExt()
        ];
        return array_filter($data);
    }

    /**
     * Send Data
     * @param array $data
     * @return CalculateShippingDateResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendData(array $data = [])
    {
        $response = $this->client->request(
            'GET',
            '/shipment/v2_2/calculate/date/shipping',
            [
                'query' => $data
            ]
        );
        return $this->response = new CalculateShippingDateResponse($this, $response->getBody()->json());
    }
}
