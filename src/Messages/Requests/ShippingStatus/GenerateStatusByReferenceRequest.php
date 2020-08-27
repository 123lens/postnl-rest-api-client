<?php
namespace Budgetlens\PostNLApi\Messages\Requests\ShippingStatus;

/**
 * Generate Status By Reference Request
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

class GenerateStatusByReferenceRequest extends AbstractShippingStatusRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Reference ID
     * @return string
     */
    public function getReferenceId(): string
    {
        return $this->getParameter('reference_id');
    }

    /**
     * Set Referemce ID
     * @param string $reference
     * @return GenerateStatusByBarcodeRequest
     */
    public function setReferenceId(string $reference)
    {
        return $this->setParameter('reference_id', $reference);
    }

    /**
     * Get Customer Code
     * @return string
     */
    public function getCustomerCode(): string
    {
        return $this->getParameter('customer_code');
    }

    /**
     * Set Customer Code
     * @param string $customerCode
     * @return GenerateStatusByReferenceRequest
     */
    public function setCustomerCode(string $customerCode)
    {
        return $this->setParameter('customer_code', $customerCode);
    }

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
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'reference_id',
            'customer_code',
            'customer_number'
        );
        $data = [
            'customerCode' => $this->getCustomerCode(),
            'customerNumber' => $this->getCustomerNumber(),
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
            "/shipment/v2/status/reference/{$this->getReferenceId()}",
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
