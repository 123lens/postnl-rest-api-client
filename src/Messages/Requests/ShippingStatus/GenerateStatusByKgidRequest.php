<?php
namespace Budgetlens\PostNLApi\Messages\Requests\ShippingStatus;

/**
 * Generate Status By Kgid (kennisgeving Id) Request
 *
 * ### Example
 * <code>
 *      $request = $client->shippingStatus()->lookup();
 *      $request->setKgid('--Kenninsgeving id--');
 *      $response = $request->send();
 *      print_r($response->getCurrentStatus());
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\ShippingStatus\ShippingStatusResponse;

class GenerateStatusByKgidRequest extends AbstractShippingStatusRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Kgid
     * @return string
     */
    public function getKgid(): string
    {
        return $this->getParameter('kgid');
    }

    /**
     * Set Kgid
     * @param string $kgid
     * @return GenerateStatusByBarcodeRequest
     */
    public function setKgid(string $kgid)
    {
        return $this->setParameter('kgid', $kgid);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'kgid'
        );
        $data = [
            'detail' => $this->getDetail(),
            'language' => $this->getLanguage(),
            'maxDays' => $this->getMaxDays()
        ];
        return array_filter($data);
    }

    public function sendData(array $data = [])
    {
        $response = $this->client->request(
            'GET',
            "/shipment/v2/status/lookup/{$this->getKgid()}",
            [
                'query' => $this->getData(),
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return $this->response = new ShippingStatusResponse($this, $response->getBody()->json());
    }
}
