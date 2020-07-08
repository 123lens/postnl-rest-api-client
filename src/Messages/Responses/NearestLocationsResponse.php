<?php
namespace Budgetlens\PostNLApi\Messages\Responses;

/**
 * Nearest Locations Response
 */

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\DeliveryOption;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Entities\OpeningHour;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class NearestLocationsResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * Get Locations
     * @return array
     */
    public function getLocations(): array
    {
        $locations = [];

        foreach ($this->getData() as $item) {
            $location = new Location($item);

            $address = new Address($item['Address']);
            $deliveryOptions = [];

            $responseOptions = $item['DeliveryOptions']['string'] ?? [];
            foreach ($responseOptions as $option) {
                $deliveryOptions[] = new DeliveryOption($option);
            }
            $hours = [];
            foreach ($item['OpeningHours'] as $day => $times) {
                $hours[] = (new OpeningHour())
                    ->setDay($day)
                    ->setHours(($times['string'] ?? ''));
            }

            $location->setAddress($address);
            $location->setOpeningHours($hours);
            $location->setDeliveryOptions($deliveryOptions);
            $locations[] = $location;

        }
        return $locations;
    }

    /**
     * Get Return Data
     * @return array|mixed
     */
    public function getData()
    {
        return $this->data['GetLocationsResult']['ResponseLocation'] ?? [];
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
     * Get Postal code
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->getParameter('postal_code');
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
     * Get Street
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->getParameter('street');
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
     * Get Delivery Date (dd-mm-YYYY)
     * @return string|null
     */
    public function getDeliveryDate(): ?string
    {
        $date = $this->getParameter('delivery_date');
        return !is_null($date) ? $date->format("d-m-Y") : null;
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
     * Get Delivery Options
     * @return array
     */
    public function getDeliveryOptions(): array
    {
        return $this->getParameters('delivery_options');
    }
}
