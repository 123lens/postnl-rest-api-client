<?php
namespace Budgetlens\PostNLApi\Traits\EntitiesHelper;


use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\DeliveryOption;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Entities\OpeningHour;

trait LocationTrait
{
    public function buildLocationEntity(array $item)
    {
        $location = new Location($item);

        $address = new Address($item['Address']);
        $deliveryOptions = [];

        $responseOptions = $item['DeliveryOptions']['string'] ?? [];
        foreach ($responseOptions as $option) {
            $deliveryOptions[] = new DeliveryOption($option);
        }
        $hours = [];
        foreach ($item['OpeningHours'] as $day => $times) {
            // PostNL handles Location entity differently per endpoint :(
            $hours[] = (new OpeningHour())
                ->setDay($day)
                ->setHours(($times['string'] ?? ''))
                ->setFrom($times['From'] ?? '')
                ->setTo($times['To'] ?? '');
        }

        $location->setAddress($address);
        $location->setOpeningHours($hours);
        $location->setDeliveryOptions($deliveryOptions);
        return $location;
    }
}
