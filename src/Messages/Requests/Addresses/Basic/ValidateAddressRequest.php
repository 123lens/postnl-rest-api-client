<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Addresses\Basic;

/**
 * Validate Basic  Address
 *
 * ### Example
 * <code>
 *      $request = $client->addresses()->validateAddressCheckBasicNational();
 *      $request->setPostalCode('1000AA')
 *      $request->setHouseNumber(1)
 *      $response = $request->send();
 *      $data = $response->getData();
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\AbstractRequest;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\Addresses\Basic\ValidateAddressResponse;

class ValidateAddressRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Postal Code
     * Zipcode of the address
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->getParameter('postal_code');
    }

    /**
     * Get Postal Code
     * Zipcode of the address
     * @param string $postalCode
     * @return AddressCheckRequest
     */
    public function setPostalCode(string $postalCode)
    {
        return $this->setParameter('postal_code', $postalCode);
    }

    /**
     * Get HouseNumber
     * The housenumber of the delivery address
     * @return int|null
     */
    public function getHouseNumber(): ?int
    {
        return $this->getParameter('house_number');
    }

    /**
     * Set HouseNumber
     * The housenumber of the delivery address
     * @param int $houseNumber
     * @return AddressCheckRequest
     */
    public function setHouseNumber(int $houseNumber)
    {
        return $this->setParameter('house_number', $houseNumber);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'postal_code',
            'house_number'
        );
        $data = [
            'postalcode' => $this->getPostalCode(),
            'housenumber' => $this->getHouseNumber()
        ];
        return array_filter($data);
    }

    /**
     * Send data
     * @param array $data
     * @return AddressCheckResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendData(array $data = [])
    {
        $response = $this->client->request(
            'GET',
            '/address/sequence',
            [
                'query' => $data
            ]
        );
        return $this->response = new ValidateAddressResponse($this, $response->getBody()->json());
    }
}
