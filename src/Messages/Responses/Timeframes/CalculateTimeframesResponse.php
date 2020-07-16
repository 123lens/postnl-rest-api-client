<?php
namespace Budgetlens\PostNLApi\Messages\Responses\Timeframes;

/**
 * Calculate Timeframes Response
 */

use Budgetlens\PostNLApi\Entities\TimeFrame;
use Budgetlens\PostNLApi\Entities\Timeframe\DeliveryTimeFrame;
use Budgetlens\PostNLApi\Entities\Timeframe\ReasonNoTimeframeEntity;
use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class CalculateTimeframesResponse extends AbstractResponse implements ResponseInterface
{
    public function getTimeframes(): array
    {
        $data = $this->getData();
        $timeframes = $data['Timeframes']['Timeframe'] ?? [];

        // return data placeholder
        $return = [];
        foreach ($timeframes as $item) {
            $timeframe = (new DeliveryTimeFrame())
                ->setDate($item['Date']);
            $tframes = $item['Timeframes']['TimeframeTimeFrame'] ?? [];
            foreach ($tframes as $tframe) {
                $tmp = $tframe['Options'] ?? [];
                $timeframe->addTimeframe(
                    (new TimeFrame())
                        ->setFrom($tframe['From'] ?? '')
                        ->setTo($tframe['To'] ?? '')
                        ->setOptions($this->getOptions($tmp))
                );
            }
            $return[] = $timeframe;
        }
        return $return;
    }

    public function getReasonNoTimeframes(): array
    {
        $data = $this->getData();
        $noTimeframes = $data['ReasonNoTimeframes']['ReasonNoTimeframe'] ?? [];
        $return = [];
        foreach ($noTimeframes as $frame) {
            $options = $frame['Options'] ?? [];
            $reason = (new ReasonNoTimeframeEntity())
                ->setCode($frame['Code'] ?? '')
                ->setDate(new \DateTime($frame['Date']))
                ->setOptions($this->getOptions($options));
            $return[] = $reason;
        }
        return $return;
    }

    /**
     * Reformat options response
     * @param $options
     * @return array
     */
    public function getOptions($options): array
    {
        // no clue why PostNL uses "string" as key.. but get rid of it..
        return array_values($options);
    }
}
