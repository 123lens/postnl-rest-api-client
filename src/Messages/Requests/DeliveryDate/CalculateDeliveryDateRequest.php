<?php
namespace Budgetlens\PostNLApi\Messages\Requests\DeliveryDate;

/**
 * Postalcode Check Request
 *
 * ### Example
 * <code>
 *      $request = $client->deliveryDate()->calculateDeliveryDate();
 *      $request->setShippingDate(\new DateTime())
 *      $request->setShippingDuration(1)
 *      $request->setCutOffTime('16:00:00')
 *      $request->setPostalCode('1000AA');
 *      $response = $request->send();
 *      $data = $response->getData();
 *      $deliveryDate = $response->getDeliveryDate();
 *      $options = $response->getDeliveryOptions();
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\AbstractRequest;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\DeliveryDate\CalculateDeliveryDateResponse;

class CalculateDeliveryDateRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    private $availableOptions = [
        'Daytime', 'Evening', 'Morning', 'Noon', 'Sunday', 'Sameday', 'Afternoon', 'MyTime'
    ];

    /**
     * Get Shipping Date
     * Date/time of preparing the shipment for sending. Format:  dd-mm-yyyy hh:mm:ss
     * @return \DateTime|null
     */
    public function getShippingDate(): ?\DateTime
    {
        return $this->getParameter('shipping_date');
    }

    /**
     * Set Shipping Date
     * Date/time of preparing the shipment for sending. Format:  dd-mm-yyyy hh:mm:ss
     * @param \DateTime $date
     * @return CalculateDeliveryDateRequest
     */
    public function setShippingDate(\DateTime $date)
    {
        return $this->setParameter('shipping_date', $date);
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
     * Get Cut Off Time
     * Format: HH:ii:ss
     * @return string|null
     */
    public function getCutOffTime(): ?string
    {
        return $this->getParameter('cut_off_time');
    }

    /**
     * Set Cut Off time (global for every day)
     *
     * Format: HH:ii:ss
     * @param string $time
     * @return CalculateDeliveryDateRequest
     */
    public function setCutOffTime(string $time)
    {
        $this->isTime($time, 'CutOffTime');
        return $this->setParameter('cut_off_time', $time);
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
     * Get (delivery) options
     * The delivery options for which a delivery date
     * should be returned. Only one delivery option can
     * be specified. See Guidelines for possible values.
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
     * Set (delivery) Options
     * The delivery options for which a delivery date
     * should be returned. Only one delivery option can
     * be specified. See Guidelines for possible values.
     * @param array $options
     * @return CalculateDeliveryDateRequest
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
     */
    public function addOption(string $option)
    {
        $this->validOption($option, $this->availableOptions);
        $options = $this->getOptions();
        $options[] = $options;
        $this->setOptions(array_filter($options));
    }

    /**
     * Get Cut Off Time Monday
     * Override cutoff time for mondays
     * @return string|null
     */
    public function getCutOffTimeMonday(): ?string
    {
        return $this->getParameter('cut_off_time_monday');
    }

    /**
     * Set Cut Off time Monday
     * Override cutoff time for mondays
     * @param string $time
     * @return CalculateDeliveryDateRequest
     */
    public function setCutOffTimeMonday(string $time)
    {
        $this->isTime($time, 'CutOffTimeMonday');
        return $this->setParameter('cut_off_time_monday', $time);
    }

    /**
     * Get Available Monday
     * Specifies if you are available to ship to PostNL on mondays
     * @return bool|null
     */
    public function getAvailableMonday(): ?bool
    {
        return $this->getParameter('available_monday');
    }

    /**
     * Set Available Monday
     * Specifies if you are available to ship to PostNL on mondays
     * @param bool $available
     * @return CalculateDeliveryDateRequest
     */
    public function setAvailableMonday(bool $available)
    {
        return $this->setParameter('available_monday', $available);
    }

    /**
     * Set Cut off Time Tuesday
     * Override cutoff time for tuesdays
     * @return string|null
     */
    public function getCutOffTimeTuesday(): ?string
    {
        return $this->getParameter('cut_off_time_tuesday');
    }

    /**
     * Set Cut Off Time Tuesday
     * Override cutoff time for tuesdays
     * @param string $time
     * @return CalculateDeliveryDateRequest
     */
    public function setCutOffTimeTuesday(string $time)
    {
        $this->isTime($time, 'CutOffTimeTuesday');
        return $this->setParameter('cut_off_time_tuesday', $time);
    }

    /**
     * Get Available Tuesday
     * Specifies if you are available to ship to PostNL on tuesdays
     * @return bool|null
     */
    public function getAvailableTuesday(): ?bool
    {
        return $this->getParameter('available_tuesday');
    }

    /**
     * Set Available Tuesday
     * Specifies if you are available to ship to PostNL on tuesdays
     * @param bool $available
     * @return CalculateDeliveryDateRequest
     */
    public function setAvailableTuesday(bool $available)
    {
        return $this->setParameter('available_tuesday', $available);
    }

    /**
     * Get Cut Off Time Wednesday
     * Override cutoff time for wednesdays
     * @return string|null
     */
    public function getCutOffTimeWednesday(): ?string
    {
        return $this->getParameter('cut_off_time_wednesday');
    }

    /**
     * Set Cut Off Time Wednesday
     * Override cutoff time for wednesdays
     * @param string $time
     * @return CalculateDeliveryDateRequest
     */
    public function setCutOffTimeWednesday(string $time)
    {
        $this->isTime($time, 'CutOffTimeWednesday');
        return $this->setParameter('cut_off_time_wednesday', $time);
    }

    /**
     * Get Available Wednesday
     * Specifies if you are available to ship to PostNL on wednesdays
     * @return bool|null
     */
    public function getAvailableWednesday(): ?bool
    {
        return $this->getParameter('available_wednesday');
    }

    /**
     * Set Available Wednesday
     * Specifies if you are available to ship to PostNL on wednesdays
     * @param bool $available
     * @return CalculateDeliveryDateRequest
     */
    public function setAvailableWednesday(bool $available)
    {
        return $this->setParameter('available_wednesday', $available);
    }

    /**
     * Get Cut Off Time Thursday
     * Override cutoff time for thursdays
     * @return string|null
     */
    public function getCutOffTimeThursday(): ?string
    {
        return $this->getParameter('cut_off_time_thursday');
    }

    /**
     * Set Cut Off Time Thursday
     * Override cutoff time for thursdays
     * @param string $time
     * @return CalculateDeliveryDateRequest
     */
    public function setCutOffTimeThursday(string $time)
    {
        $this->isTime($time, 'CutOffTimeThursday');
        return $this->setParameter('cut_off_time_thursday', $time);
    }

    /**
     * Get Available Thursday
     * Specifies if you are available to ship to PostNL on thursdays
     * @return bool|null
     */
    public function getAvailableThursday(): ?bool
    {
        return $this->getParameter('available_thursday');
    }

    /**
     * Set Available Thursday
     * Specifies if you are available to ship to PostNL on thursdays
     * @param bool $available
     * @return CalculateDeliveryDateRequest
     */
    public function setAvailableThursday(bool $available)
    {
        return $this->setParameter('available_thursday', $available);
    }

    /**
     * Get Cut Off Time Friday
     * Override cutoff time for fridays
     * @return string|null
     */
    public function getCutOffTimeFriday(): ?string
    {
        return $this->getParameter('cut_off_time_friday');
    }

    /**
     * Set Cut Off Time Friday
     * Override cutoff time for fridays
     * @param string $time
     * @return CalculateDeliveryDateRequest
     */
    public function setCutOffTimeFriday(string $time)
    {
        $this->isTime($time, 'CutOffTimeFriday');
        return $this->setParameter('cut_off_time_friday', $time);
    }

    /**
     * Get Available Friday
     * Specifies if you are available to ship to PostNL on fridays
     * @return bool|null
     */
    public function getAvailableFriday(): ?bool
    {
        return $this->getParameter('available_friday');
    }

    /**
     * Set Available Friday
     * Specifies if you are available to ship to PostNL on fridays
     * @param bool $available
     * @return CalculateDeliveryDateRequest
     */
    public function setAvailableFriday(bool $available)
    {
        return $this->setParameter('available_friday', $available);
    }

    /**
     * Get Cut Off Time Saturday
     * Override cutoff time for saturdays
     * @return string|null
     */
    public function getCutOffTimeSaturday(): ?string
    {
        return $this->getParameter('cut_off_time_saturday');
    }

    /**
     * Set Cut Off Time Saturday
     * Override cutoff time for saturdays
     * @param string $time
     * @return CalculateDeliveryDateRequest
     */
    public function setCutOffTimeSaturday(string $time)
    {
        $this->isTime($time, 'CutOffTimeSaturday');
        return $this->setParameter('cut_off_time_saturday', $time);
    }

    /**
     * Get Available Saturday
     * Specifies if you are available to ship to PostNL on saturdays
     * @return bool|null
     */
    public function getAvailableSaturday(): ?bool
    {
        return $this->getParameter('available_saturday');
    }

    /**
     * Set Available Saturday
     * Specifies if you are available to ship to PostNL on saturdays
     * @param bool $available
     * @return CalculateDeliveryDateRequest
     */
    public function setAvailableSaturday(bool $available)
    {
        return $this->setParameter('available_saturday', $available);
    }

    /**
     * Get Cut Off Time Sunday
     * Override cutoff time for sundays
     * @return string|null
     */
    public function getCutOffTimeSunday(): ?string
    {
        return $this->getParameter('cut_off_time_sunday');
    }

    /**
     * Set Cut Off Time Sunday
     * Override cutoff time for sundays
     * @param string $time
     * @return CalculateDeliveryDateRequest
     */
    public function setCutOffTimeSunday(string $time)
    {
        $this->isTime($time, 'CutOffTimeSunday');
        return $this->setParameter('cut_off_time_sunday', $time);
    }

    /**
     * Get Available Sunday
     * Specifies if you are available to ship to PostNL on sundays
     * @return bool|null
     */
    public function getAvailableSunday(): ?bool
    {
        return $this->getParameter('available_sunday');
    }

    /**
     * Set Available Sunday
     * Specifies if you are available to ship to PostNL on sundays
     * @param bool $available
     * @return CalculateDeliveryDateRequest
     */
    public function setAvailableSunday(bool $available)
    {
        return $this->setParameter('available_sunday', $available);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'shipping_date',
            'shipping_duration',
            'cut_off_time',
            'postal_code'
        );

        $data = [
            'ShippingDate' => $this->getShippingDate()->format('d-m-Y H:i:s'),
            'ShippingDuration' => $this->getShippingDuration(),
            'CutOffTime' => $this->getCutOffTime(),
            'PostalCode' => $this->getPostalCode(),
            'CountryCode' => $this->getCountryCode(),
            'OriginCountryCode' => $this->getOriginCountryCode(),
            'City' => $this->getCity(),
            'Street' => $this->getStreet(),
            'HouseNumber' => $this->getHouseNumber(),
            'HouseNrExt' => $this->getHouseNrExt(),
            'Options' => $this->getOptions(),
            'CutOffTimeMonday' => $this->getCutOffTimeMonday(),
            'AvailableMonday' => $this->getAvailableMonday(),
            'CutOffTimeTuesday' => $this->getCutOffTimeTuesday(),
            'AvailableTuesday' => $this->getAvailableTuesday(),
            'CutOffTimeWednesday' => $this->getCutOffTimeWednesday(),
            'AvailableWednesday' => $this->getAvailableWednesday(),
            'CutOffTimeThursday' => $this->getCutOffTimeThursday(),
            'AvailableThursday' => $this->getAvailableThursday(),
            'CutOffTimeFriday' => $this->getCutOffTimeFriday(),
            'AvailableFriday' => $this->getAvailableFriday(),
            'CutOffTimeSaturday' => $this->getCutOffTimeSaturday(),
            'AvailableSaturday' => $this->getAvailableSaturday(),
            'CutOffTimeSunday' => $this->getCutOffTimeSunday(),
            'AvailableSunday' => $this->getAvailableSunday()
        ];
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
            '/shipment/v2_2/calculate/date/delivery',
            [
                'query' => $data
            ]
        );
        return $this->response = new CalculateDeliveryDateResponse($this, $response->getBody()->json());
    }
}
