<?php
namespace Budgetlens\PostNLApi\Messages\Responses;

/**
 * Checkout Response
 */

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Checkout\Warning;
use Budgetlens\PostNLApi\Entities\DeliveryDateOption;
use Budgetlens\PostNLApi\Entities\Location;
use Budgetlens\PostNLApi\Entities\PickupOption;
use Budgetlens\PostNLApi\Entities\TimeFrame;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;
use Budgetlens\PostNLApi\Traits\EntitiesHelper\LocationTrait;

class CheckoutResponse extends AbstractResponse implements ResponseInterface
{
    use LocationTrait;

    /**
     * Get Return Data
     * @return array|mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get Available delivery options
     * @return array
     */
    public function getDeliveryOptions(): array
    {
        $data = $this->getData();
        $deliveryOptions = $data['DeliveryOptions'] ?? [];
        $return = [];
        foreach ($deliveryOptions as $option) {
            // rebuild timeframes to entities
            $timeframes = [];
            if (isset($option['Timeframe']) && is_array($option['Timeframe'])) {
                foreach ($option['Timeframe'] as $frame) {
                    $timeframes[] = (new TimeFrame())
                        ->setFrom($frame['From'])
                        ->setTo($frame['To'])
                        ->setOptions($frame['Options'])
                        ->setShippingDate($frame['ShippingDate']);
                }
            }
            $return[] = (new DeliveryDateOption())
                ->setDeliveryDate(new \DateTime($option['DeliveryDate'] ?? null))
                ->setTimeframe($timeframes);
        }
        return $return;
    }

    /**
     * Get Pickup Options
     * @return array
     * @throws \Exception
     */
    public function getPickupOptions(): array
    {
        $data = $this->getData();
        $pickupOptions = $data['PickupOptions'] ?? [];
        $return = [];
        foreach ($pickupOptions as $option) {
            $pickup = (new PickupOption())
                ->setPickupDate(new \DateTime($option['PickupDate']));
            if (isset($option['ShippingDate'])) {
                $pickup->setShippingDate(new \DateTime($option['ShippingDate']));
            }
            if (isset($option['Option'])) {
                $pickup->setOption($option['Option']);
            }
            // build locations.
            foreach ($option['Locations'] as $locationItem) {
                $pickup->addLocation($this->buildLocationEntity($locationItem));
            }
            $return[] = $pickup;
        }

        return $return;
    }

    /**
     * Get Warnings
     * @return array
     * @throws \Exception
     */
    public function getWarnings(): array
    {
        $data = $this->getData();
        $warnings = $data['Warnings'] ?? [];
        $return = [];
        foreach ($warnings as $warning) {
            $return[] = (new Warning())
                ->setCode($warning['Code'] ?? '')
                ->setDescription($warning['Description'] ?? '')
                ->setDeliveryDate(new \DateTime($warning['DeliveryDate']))
                ->setOptions($warning['Options'] ?? []);
        }
        return $return;
    }
}
