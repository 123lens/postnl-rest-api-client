<?php
namespace Budgetlens\PostNLApi\Messages\Responses;

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\DeliveryOption;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Entities\OpeningHour;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

/**
 * Abstract Locations Response
 * Class AbstractLocationsResponse
 * @package Budgetlens\PostNLApi\Messages\Responses
 */

abstract class AbstractLocationsResponse extends AbstractResponse implements ResponseInterface
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

}
