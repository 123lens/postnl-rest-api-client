<?php
namespace Budgetlens\PostNLApi\Messages\Requests\ShippingStatus;

/**
 * Generate Status By Barcode Request
 *
 * ### Example
 * <code>
 *      $request = $client->shippingStatus()->barcode();
 *      $request->setBarcode('--barcode--');
 *      $response = $request->send();
 *      print_r($response->getCurrentStatus());
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\ShippingStatus\ShippingStatusResponse;

class GenerateStatusByBarcodeRequest extends AbstractShippingStatusRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Barcode
     * @return string
     */
    public function getBarocde(): string
    {
        return $this->getParameter('barcode');
    }

    /**
     * Set Barcode
     * @param string $barcode
     * @return GenerateStatusByBarcodeRequest
     */
    public function setBarcode(string $barcode)
    {
        return $this->setParameter('barcode', $barcode);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'barcode'
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
            "/shipment/v2/status/barcode/{$this->getBarocde()}",
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
