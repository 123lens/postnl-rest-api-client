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
    /**
     * Get Available timeframes
     * @return array
     * @throws \Exception
     */
    public function getTimeframes(): array
    {
        $data = $this->getData();
        $timeframes = $data['Timeframes']['Timeframe'] ?? [];

        // return data placeholder
        $return = [];
        foreach ($timeframes as $item) {
            $timeframe = (new DeliveryTimeFrame())
                ->setDate(new \DateTime($item['Date']));
            $tframes = $item['Timeframes']['TimeframeTimeFrame'] ?? [];
            if (!isset($tframes[0])) { // assoc array
                $tframes = array($tframes);
            }
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

    /**
     * Get Reasons no timeframe
     * @return array
     * @throws \Exception
     */
    public function getReasonNoTimeframes(): array
    {
        $data = $this->getData();
        $noTimeframes = $data['ReasonNoTimeframes']['ReasonNoTimeframe'] ?? [];
        $return = [];
        foreach ($noTimeframes as $frame) {
            $options = $frame['Options'] ?? [];
            $reason = (new ReasonNoTimeframeEntity())
                ->setCode($frame['Code'] ?? '')
                ->setDescription($frame['Description'] ?? '')
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
    private function getOptions($options): array
    {
        // no clue why PostNL uses "string" as key.. but get rid of it..
        return array_values($options);
    }
}
