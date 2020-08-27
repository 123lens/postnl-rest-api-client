<?php
namespace Budgetlens\PostNLApi\Messages\Requests\ShippingStatus;

/**
 * Generate Signature Status By Barcode Request
 *
 * ### Example
 * <code>
 *      $request = $client->shippingStatus()->shipment();
 *      $request->setCustomerCode('--CUSTOMER_CODE--');
 *      $request->addPeriod(new \DateTime('2020-08-07'))
 *      $request->addPeriod(new \DateTime('2020-08-08'));
 *      $response = $request->send();
 *      print_r($response->getData());
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\ShippingStatus\ShippingStatusResponse;

class GenerateUpdatedShipmentsByCustomerNumberRequest extends AbstractShippingStatusRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Customer Number
     * @return string
     */
    public function getCustomerNumber(): string
    {
        return $this->getParameter('customer_number');
    }

    /**
     * Set Customer Number
     * @param string $customerNumber
     * @return GenerateStatusByReferenceRequest
     */
    public function setCustomerNumber(string $customerNumber)
    {
        return $this->setParameter('customer_number', $customerNumber);
    }

    /**
     * Get Periods
     * @return array
     */
    public function getPeriods(): array
    {
        $periods = $this->getParameter('periods');
        return is_array($periods)
            ? $periods
            : [];
    }

    /**
     * Add Period
     * @param \DateTime $period
     * @return GenerateUpdatedShipmentsByCustomerNumberRequest
     */
    public function addPeriod(\DateTime $period)
    {
        $periods = $this->getPeriods();
        $periods[] = $period;
        return $this->setParameter('periods', $periods);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'customer_number'
        );

        $periods = $this->getPeriods();
        $data = [
            'periods' => count($periods) ? $periods : ''
        ];
        return array_filter($data);
    }

    public function sendData(array $data = [])
    {
        // query placeholder
        $query = '';
        // don't known why PostNL choosen to use period parameter multiple times in the query segment
        $periods = $data['periods'] ?? [];
        if (count($periods)) {
            foreach ($periods as $period) {
                $query .=  ($query !== '') ? '&' : '';
                $query .= "period=" . $period->format('c');
            }
        }
        $response = $this->client->request(
            'GET',
            "/shipment/v2/status/{$this->getCustomerNumber()}/updatedshipments",
            [
                'query' => $query,
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return $this->response = new ShippingStatusResponse($this, $response->getBody()->json());
    }
}
