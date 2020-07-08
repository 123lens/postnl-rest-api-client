<?php
namespace Budgetlens\PostNLApi\Messages\Responses;

/**
 * Location Lookup Response
 */

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\DeliveryOption;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Entities\OpeningHour;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class LocationLookupResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * Get Location
     * @return Location
     */
    public function getLocation(): Location
    {
        $locations = [];

        $item = $this->getData();
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
        return $location;
    }

    /**
     * Get Return Data
     * @return array|mixed
     */
    public function getData()
    {
        return $this->data['GetLocationsResult']['ResponseLocation'] ?? [];
    }
}
