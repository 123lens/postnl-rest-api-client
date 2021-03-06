<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Barcode;

/**
 * Abstract Barcode Request
 *
 */
use Budgetlens\PostNLApi\Messages\Requests\AbstractRequest;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\Barcode\GenerateBarcodeResponse;

abstract class AbstractGenerateBarcodeRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    /**
     * Possible barcodes series per barcode type.
     */
    const NL_BARCODE_SERIE_LONG   = '0000000000-9999999999';
    const NL_BARCODE_SERIE_SHORT  = '000000000-999999999';
    const EU_BARCODE_SERIE_LONG   = '00000000-99999999';
    const EU_BARCODE_SERIE_SHORT  = '0000000-9999999';
    const GLOBAL_BARCODE_SERIE    = '0000-9999';

    private $availableOptions = [
        '2S', '3S', 'CC', 'CP', 'CD', 'CF', 'LA'
    ];

    /**
     * Get Customer Code
     * @return string|null
     */
    public function getCustomerCode(): ?string
    {
        return $this->getParameter('customer_code');
    }

    /**
     * Set Customer Code
     * @param string $customerCode
     * @return GenerateBarcodeRequest
     */
    public function setCustomerCode(string $customerCode)
    {
        return $this->setParameter('customer_code', $customerCode);
    }

    /**
     * Get Customer Number
     * @return string|null
     */
    public function getCustomerNumber(): ?string
    {
        return $this->getParameter('customer_number');
    }

    /**
     * Set Customer Number
     * @param string $number
     * @return GenerateBarcodeRequest
     */
    public function setCustomerNumber(string $number)
    {
        return $this->setParameter('customer_number', $number);
    }

    /**
     * Get Type
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->getParameter('type');
    }

    /**
     * Set Type
     * @param string $type
     * @return GenerateBarcodeRequest
     */
    public function setType(string $type)
    {
        $this->validOption($type, $this->availableOptions);
        return $this->setParameter('type', $type);
    }

    /**
     * Get Serie
     * @return string|null
     */
    public function getSerie(): ?string
    {
        return $this->getParameter('serie');
    }

    /**
     * Set Serie
     *
     * @param string $serie
     * @return GenerateBarcodeRequest
     */
    public function setSerie(string $serie)
    {
        return $this->setParameter('serie', $serie);
    }


    /**
     * Get Range
     * @return string|null
     */
    public function getRange(): ?string
    {
        return $this->getParameter('range');
    }

    /**
     * Set Range
     * @param string $range
     * @return GenerateBarcodeRequest
     */
    public function setRange(string $range)
    {
        return $this->setParameter('range', $range);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'customer_code',
            'customer_number',
            'type'
        );
        $data = [
            'CustomerCode' => $this->getCustomerCode(),
            'CustomerNumber' => $this->getCustomerNumber(),
            'Type' => $this->getType(),
            'Serie' => $this->getSerie(),
            'Range' => $this->getRange()
        ];
        return array_filter($data);
    }

    /**
     * Send data
     * @param array $data
     * @return LocationLookupResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendData(array $data = [])
    {
        $response = $this->client->request(
            'GET',
            '/shipment/v1_1/barcode',
            [
                'query' => $data
            ]
        );
        return $this->response = new GenerateBarcodeResponse($this, $response->getBody()->json());
    }
}
