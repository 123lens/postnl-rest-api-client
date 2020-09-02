<?php
namespace Budgetlens\PostNLApi\Messages\Requests;

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
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\CheckoutResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;

class CheckoutRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    private $availableDeliveryOptions = [
        'Daytime', 'Evening', 'Sunday', 'Sameday', 'DeliveryOnDemand',
        '08:00-10:00', '08:00-12:00', '08:00-17:00', '08:00-09:00', '09:00-12:00', '09:00-16:00', '12:00-17:00',
        'Pickup'
    ];


    /**
     * Get OrderDate
     * @return string|null
     */
    public function getOrderDate(): ?string
    {
        $orderDate = $this->getParameter('order_date');
        return !is_null($orderDate)
            ? $orderDate->format('d-m-Y H:i:s')
            : null;
    }

    /**
     * Set Orderdate
     * @param \DateTime $orderdate
     * @return NearestLocationsRequest
     */
    public function setOrderDate(\DateTime $orderdate)
    {
        return $this->setParameter('order_date', $orderdate);
    }

    /**
     * Get Shipping Duration
     * @return int|null
     */
    public function getShippingDuration(): ?int
    {
        return $this->getParameter('shipping_duration');
    }

    /**
     * Set Shipping Duration
     * @param int $houseNumber
     */
    public function setShippingDuration(int $duration)
    {
        $this->setParameter('shipping_duration', $duration);
    }

    /**
     * Get CutOffTime
     * @return array
     */
    public function getCutOffTime(): array
    {
        $cutOff = $this->getParameter('cut_off_times');
        return is_array($cutOff)
            ? $cutOff
            : [];
    }

    /**
     * Set Cut Off Time
     * @param array $cutOffTime
     * @return CheckoutRequest
     */
    public function setCutOffTime(array $cutOffTime = [])
    {
        return $this->setParameter('cut_off_times', $cutOffTime);
    }
    /**
     * Set Cut Off Time
     * @param string $day
     * @param bool $available
     * @param string $time - format: HH:ii:ss
     * @param string $type
     * @return CheckoutRequest
     */
    public function addCutOffTime(string $day, bool $available, string $time, string $type = 'Regular')
    {
        if (!preg_match("/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/", $time)) {
            throw new \InvalidArgumentException("Invalid time, format: HH:ii:ss");
        }

        $cutOffTimes = $this->getCutOffTime();

        $cutOffTimes[] = [
            'Day' => $day,
            'Available' => $available,
            'Type' => $type,
            'Time' => $time
        ];
        return $this->setCutOffTime($cutOffTimes);
    }

    /**
     * Get Holiday Sorting
     * @return bool
     */
    public function getHolidaySorting(): bool
    {
        return (bool)$this->getParameter('holiday_sorting');
    }

    /**
     * Set Holiday Sorting
     * @param bool $holidaySorting
     * @return CheckoutRequest
     */
    public function setHolidaySorting(bool $holidaySorting)
    {
        return $this->setParameter('holiday_sorting', $holidaySorting);
    }

    /**
     * Get Delivery Options
     * @return array
     */
    public function getDeliveryOptions(): array
    {
        $options = $this->getParameter('delivery_options');
        return is_array($options)
            ? $options
            : [];
    }

    /**
     * Set Delivery Options
     * @param array $options
     * @return CheckoutRequest
     */
    public function setDeliveryOptions(array $options)
    {
        return $this->setParameter('delivery_options', $options);
    }

    /**
     * Add Delivery Options
     * @param string $option
     * @return CheckoutRequest
     */
    public function addDeliveryOption(string $option)
    {
        $this->validOption($option, $this->availableDeliveryOptions);
        $options = $this->getDeliveryOptions();
        $options[] = $option;
        return $this->setDeliveryOptions(array_unique($options));
    }

    /**
     * Get Locations
     * @return int|null
     */
    public function getLocations(): ?int
    {
        return $this->getParameter('locations');
    }

    /**
     * Set Locations
     * @param int $locations
     * @return CheckoutRequest
     */
    public function setLocations(int $locations)
    {
        if ($locations < 1 || $locations > 3) {
            throw new \InvalidArgumentException("Location must be between 1-3");
        }
        return $this->setParameter('locations', $locations);
    }

    /**
     * Get Days
     * @return int|null
     */
    public function getDays(): ?int
    {
        return $this->getParameter('days');
    }

    /**
     * Set Days
     * @param int $days
     * @return CheckoutRequest
     */
    public function setDays(int $days)
    {
        if ($days < 1 || $days > 9) {
            throw new \InvalidArgumentException("Location must be between 1-9");
        }
        return $this->setParameter('days', $days);
    }

    /**
     * Get Addresses
     * @return array
     */
    public function getAddresses(): array
    {
        $addresses = $this->getParameter('addresses');
        return is_array($addresses)
            ? $addresses
            : [];
    }

    /**
     * Set Addresses
     * @param array $addresses
     * @return CheckoutRequest
     */
    public function setAddresses(array $addresses)
    {
        return $this->setParameter('addresses', $addresses);
    }

    /**
     * Add an address
     * @param array $address
     * @return CheckoutRequest
     */
    public function addAddress(array $address)
    {
        $addressDefaults = [
            'AddressType' => '01',
            'Street' => '',
            'HouseNr' => 0,
            'HouseNrExt' => '',
            'Zipcode' => '',
            'City' => '',
            'Countrycode' => "NL"
        ];
        $mandatoryKeys = [
            'AddressType', 'HouseNr', 'Zipcode', 'Countrycode'
        ];
        foreach ($mandatoryKeys as $key) {
            if (!isset($address[$key])) {
                throw new \InvalidArgumentException("The $key parameter is required");
            }
        }
        $this->validOption($address['AddressType'], ['01', '09']);

        $addresses = $this->getAddresses();
        $addresses[] = array_merge(
            $addressDefaults,
            $address
        );
        return $this->setAddresses($addresses);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'order_date',
            'cut_off_times',
            'delivery_options',
            'locations',
            'days',
            'addresses'
        );

        $data = [
            'OrderDate' => $this->getOrderDate(),
            'ShippingDuration' => $this->getShippingDuration(),
            'CutOffTimes' => $this->getCutOffTime(),
            'HolidaySorting' => $this->getHolidaySorting(),
            'Options' => $this->getDeliveryOptions(),
            'Locations' => $this->getLocations(),
            'Days' => $this->getDays(),
            'Addresses' => $this->getAddresses()
        ];
        return array_filter($data);
    }

    /**
     * Send data
     * @param array $data
     * @return NearestLocationsResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendData(array $data = [])
    {
        $json = <<<EOD
{
   "OrderDate":"08-07-2020 15:48:37",
   "CutOffTimes":[
      {
         "Day":"01",
         "Available":true,
         "Type":"Regular",
         "Time":"16:00:00"
      }
   ],
   "Options":[
      "Daytime"
   ],
   "Locations":3,
   "Days":1,
   
  "Addresses": [{
        "AddressType": "01",
        "Street": "Churchillstraat",
        "HouseNr": 22,
        "HouseNrExt": "",
        "Zipcode": "1411XC",
        "City": "Naarden",
        "Countrycode": "NL"
    }
  ]
}
EOD;
//
//        $json = <<<EOD
//        {
//            "OrderDate": "08-07-2020 16:00:00",
//  "ShippingDuration": "1",
//  "CutOffTimes": [
//    {
//        "Day": "01",
//      "Available": true,
//      "Type": "Regular",
//      "Time": "16:00:00"
//    }
//  ],
//  "HolidaySorting": true,
//  "Options": [
//            "Daytime"
//        ],
//  "Locations": 3,
//  "Days": 1,
//  "Addresses": [{
//        "AddressType": "01",
//        "Street": "Churchillstraat",
//        "HouseNr": 22,
//        "HouseNrExt": "",
//        "Zipcode": "1411XC",
//        "City": "Naarden",
//        "Countrycode": "NL"
//    }
//  ]
//}
//EOD;
        $response = $this->client->request(
            'POST',
            '/shipment/v1/checkout',
            [
                'body' => json_encode($data),
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]
        );
        return $this->response = new CheckoutResponse($this, $response->getBody()->json());
    }
}
