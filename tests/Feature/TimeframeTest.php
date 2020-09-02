<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Client\Middleware\ErrorResponseException;
use Budgetlens\PostNLApi\Entities\TimeFrame;
use Budgetlens\PostNLApi\Entities\Timeframe\DeliveryTimeFrame;
use Budgetlens\PostNLApi\Entities\Timeframe\ReasonNoTimeframeEntity;
use Budgetlens\PostNLApi\Messages\Responses\Timeframes\CalculateTimeframesResponse;
use Tests\TestCase;

class TimeframeTest extends TestCase
{
    /**
     * @test
     */
    public function calculateTimeframesSuccess()
    {
        $request = $this->getClient('Timeframe/calculateTimeframeSuccess.json')->timeframe()->calculateTimeframes();
        $request->setStartDate(new \DateTime())
            ->setEndDate((new \DateTime())->add(new \DateInterval("P7D")))
            ->addOption('Daytime')
            ->setAllowSundaySorting(false)
            ->setCountryCode("NL")
            ->setPostalCode('1000AA')
            ->setHouseNumber(1);
        $response = $request->send();
        $this->assertInstanceOf(CalculateTimeframesResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertIsArray($response->getTimeframes());
        $this->assertCount(6, $response->getTimeframes());
        $this->assertInstanceOf(DeliveryTimeFrame::class, $response->getTimeframes()[0]);
        $this->assertInstanceOf(\DateTime::class, $response->getTimeframes()[0]->getDate());
        $this->assertIsArray($response->getTimeframes()[0]->getTimeframes());
        $this->assertInstanceOf(TimeFrame::class, $response->getTimeframes()[0]->getTimeframes()[0]);
        $this->assertSame('16-07-2020', $response->getTimeframes()[0]->getDate()->format('d-m-Y'));
        $this->assertEquals('12:45:00', $response->getTimeframes()[0]->getTimeframes()[0]->getFrom());
        $this->assertEquals('15:15:00', $response->getTimeframes()[0]->getTimeframes()[0]->getTo());
        // no timeframe
        $this->assertIsArray($response->getReasonNoTimeframes());
        $this->assertCount(2, $response->getReasonNoTimeframes());
        $this->assertInstanceOf(ReasonNoTimeframeEntity::class, $response->getReasonNoTimeframes()[0]);
        $this->assertInstanceOf(\DateTime::class, $response->getReasonNoTimeframes()[0]->getDate());
        $this->assertIsArray($response->getReasonNoTimeframes()[0]->getOptions());
        $this->assertSame('19-07-2020', $response->getReasonNoTimeframes()[0]->getDate()->format('d-m-Y'));
        $this->assertEquals('03', $response->getReasonNoTimeframes()[0]->getCode());
        $this->assertEquals('Dag uitgesloten van tijdvak', $response->getReasonNoTimeframes()[0]->getDescription());
    }

    /**
     * @test
     */
    public function calculateTimeframesErrorMissingEntity()
    {
        $this->expectException(\InvalidArgumentException::class);
        $request = $this->getClient()->timeframe()->calculateTimeframes();
        $request->setStartDate(new \DateTime())
            ->setEndDate((new \DateTime())->add(new \DateInterval("P7D")))
            ->setAllowSundaySorting(false)
            ->setCountryCode("NL")
            ->setPostalCode('1000AA')
            ->setHouseNumber(1);
        $response = $request->send();
    }

    /**
     * @tes
     */
    public function calculateTimeframesResponseError()
    {
        $this->expectException(ErrorResponseException::class);
        $request = $this->getClient('Timeframe/calculateTimeframeError.json', 400)->timeframe()->calculateTimeframes();
        $request->setStartDate(new \DateTime())
            ->setEndDate((new \DateTime())->add(new \DateInterval("P7D")))
            ->addOption('Daytime')
            ->setAllowSundaySorting(false)
            ->setCountryCode("NL")
            ->setPostalCode('1000AA')
            ->setHouseNumber(1);
        $response = $request->send();
    }

    /**
     * @test
     */
    public function calculateTimeframesResponseErrorExceptionMatch()
    {
        try {
            $request = $this->getClient('Timeframe/calculateTimeframeError.json', 400)->timeframe()->calculateTimeframes();
            $request->setStartDate(new \DateTime())
                ->setEndDate((new \DateTime())->add(new \DateInterval("P7D")))
                ->addOption('Daytime')
                ->setAllowSundaySorting(false)
                ->setCountryCode("NL")
                ->setPostalCode('1000AA')
                ->setHouseNumber(1);
            $response = $request->send();
        } catch (ErrorResponseException $e) {
            $this->assertSame(7, $e->getErrors()[0]['ErrorNumber']);
        }
    }
}
