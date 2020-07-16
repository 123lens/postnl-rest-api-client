<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Timeframes;

/**
 * Calculate Timeframes Request
 *
 * ### Example
 * <code>
 *      $request = $client->timeframe()->calculateTimeframes();
 *      $request->setStartDate(new \DateTime())
 *      $request->setEndDate((new \DateTime())->add(new \DateInterval("P7D")))
 *      $request->addOption('Daytime')
 *      $request->setAllowSundaySorting(false)
 *      $request->setCountryCode("NL")
 *      $request->setPostalCode('1000AA')
 *      $request->setHouseNumber(1);
 *
 *      $response = $request->send();
 *      $data = $response->getData();
 *      $timeframes = $response->getTimeframes();
 *      $noTimeframes = $response->getReasonNoTimeframes();
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\AbstractRequest;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\DeliveryDate\CalculateDeliveryDateResponse;
use Budgetlens\PostNLApi\Messages\Responses\Timeframes\CalculateTimeframesResponse;

class CalculateTimeframesRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    private $availableOptions = [
        'Daytime', 'Sameday', 'Evening', 'Morning', 'Noon', 'Sunday', 'Afternoon', 'MyTime'
    ];

    /**
     * Get Start Date
     * Date of the beginning of the timeframe. Format:dd-mm-yyyy
     * @return \DateTime|null
     */
    public function getStartDate(): ?\DateTime
    {
        return $this->getParameter('start_date');
    }

    /**
     * Set Start Date
     * Date of the beginning of the timeframe. Format:dd-mm-yyyy
     * @param \DateTime $date
     * @return CalculateTimeframesRequest
     */
    public function setStartDate(\DateTime $date)
    {
        return $this->setParameter('start_date', $date);
    }

    /**
     * Get End Date
     * Date of the enddate of the timeframe. Format:dd-mm-yyyy Enddate may not be before StartDate.
     * @return \DateTime|null
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->getParameter('end_date');
    }

    /**
     * Set End Date
     * Date of the enddate of the timeframe. Format:dd-mm-yyyy Enddate may not be before StartDate.
     * @param \DateTime $date
     * @return CalculateTimeframesRequest
     */
    public function setEndDate(\DateTime $date)
    {
        return $this->setParameter('end_date', $date);
    }

    /**
     * Get (delivery) options
     * The delivery options for which timeframes should be returned. At least one delivery option must be specified.
     * See Guidelines for possible values.
     * Available values : Daytime, Sameday, Evening, Morning, Noon, Sunday, Afternoon, MyTime
     * @return array
     */
    public function getOptions(): array
    {
        $options = $this->getParameter('options');
        return is_array($options)
            ? $options
            : [];
    }

    /**
     * Set (delivery) options
     * The delivery options for which timeframes should be returned. At least one delivery option must be specified.
     * See Guidelines for possible values.
     * Available values : Daytime, Sameday, Evening, Morning, Noon, Sunday, Afternoon, MyTime
     * @param array $options
     * @return CalculateTimeframesRequest
     */
    public function setOptions(array $options)
    {
        return $this->setParameter('options', $options);
    }

    /**
     * Add a delivery option
     * The delivery options for which a delivery date
     * should be returned. Only one delivery option can
     * be specified. See Guidelines for possible values.
     * @param string $option
     * @return CalculateTimeframesRequest
     */
    public function addOption(string $option)
    {
        $this->validOption($option, $this->availableOptions);
        $options = $this->getOptions();
        $options[] = $option;
        return $this->setOptions(array_filter($options));
    }

    /**
     * Get Allow Sunday Sorting
     * Whether or not the requesting party allows for Sunday sorting (which leads to delivery on Monday).
     * @return bool|null
     */
    public function getAllowSundaySorting(): ?bool
    {
        return $this->getParameter('allow_sunday_sorting');
    }

    /**
     * Set Allow Sunday Sorting
     * Whether or not the requesting party allows for Sunday sorting (which leads to delivery on Monday).
     * @param bool $allow
     * @return CalculateTimeframesRequest
     */
    public function setAllowSundaySorting(bool $allow)
    {
        return $this->setParameter('allow_sunday_sorting', $allow);
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
     * Get Interval
     * Optional filter for MyTime shipments (possible values: 60/30);
     * choose 60 if you only want ‘whole hour’ timeframes returned
     * @return int|null
     */
    public function getInterval(): ?int
    {
        return $this->getParameter('interval');
    }

    /**
     * Set Interval
     * Optional filter for MyTime shipments (possible values: 60/30); choose 60 if you only want
     * ‘whole hour’ timeframes returned
     * @param int $interval
     * @return CalculateTimeframesRequest
     */
    public function setInterval(int $interval)
    {
        $this->validOption($interval, [30,60]);
        return $this->setParameter('interval', $interval);
    }

    /**
     * Get Timeframe Range
     * Optional filter for MyTime shipments; format hh:mm-hh:mm. Specifies which timeframes you want returned
     * in the response
     * @return string|null
     */
    public function getTimeframeRange(): ?string
    {
        return $this->getParameter('timeframe_range');
    }

    /**
     * Set Timeframe range
     * Optional filter for MyTime shipments; format hh:mm-hh:mm. Specifies which timeframes you want returned
     * in the response
     * @param string $timeFrame
     * @return CalculateTimeframesRequest
     */
    public function setTimeframeRange(string $timeFrame)
    {
        if (!preg_match("/^[0-9]{2}:[0-9]{2}-[0-9]{2}:[0-9]{2}/$", $timeFrame)) {
            throw new \InvalidArgumentException(
                "Invalid format for timeframeRange, format: HH:ii-HH:ii"
            );
        }
        return $this->setParameter('timeframe_range', $timeFrame);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'start_date',
            'end_date',
            'options',
            'allow_sunday_sorting',
            'country_code',
            'postal_code',
            'house_number'
        );

        $data = [
            'StartDate' => $this->getStartDate()->format('d-m-Y'),
            'EndDate' => $this->getEndDate()->format('d-m-Y'),
            'Options' => $this->getOptions(),
            'AllowSundaySorting' => $this->getAllowSundaySorting(),
            'CountryCode' => $this->getCountryCode(),
            'City' => $this->getCity(),
            'PostalCode' => $this->getPostalCode(),
            'Street' => $this->getStreet(),
            'HouseNumber' => $this->getHouseNumber(),
            'HouseNrExt' => $this->getHouseNrExt(),
            'Interval' => $this->getInterval(),
            'TimeframeRange' => $this->getTimeframeRange()
        ];
        return $data;
        return array_filter($data);
    }

    /**
     * Send data
     * @param array $data
     * @return PostalcodeCheckResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendData(array $data = [])
    {
        $response = $this->client->request(
            'GET',
            '/shipment/v2_1/calculate/timeframes',
            [
                'query' => $data
            ]
        );
        return $this->response = new CalculateTimeframesResponse($this, $response->getBody()->json());
    }
}
