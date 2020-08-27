<?php
namespace Budgetlens\PostNLApi\Messages\Requests\ShippingStatus;

/**
 * Generate Signature Status By Barcode Request
 *
 * ### Example
 * <code>
 *      $request = $client->barcode()->generateBarcodeDomestic();
 *      $request->setCustomerCode('--CUSTOMER_CODE--');
 *      $request->setCustomerNumber('--CUSTOMER_NUMBER--');
 *      $response = $request->send();
 *      $barcode = $response->getBarcode();
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\Shipping\GenerateShipmentResponse;
use Budgetlens\PostNLApi\Messages\Responses\ShippingStatus\ShippingStatusResponse;

class GenerateSignatureStatusByBarcodeRequest extends AbstractShippingStatusRequest implements RequestInterface, MessageInterface
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
        return [];
    }

    public function sendData(array $data = [])
    {
        $response = $this->client->request(
            'GET',
            "/shipment/v2/status/signature/{$this->getBarocde()}",
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
