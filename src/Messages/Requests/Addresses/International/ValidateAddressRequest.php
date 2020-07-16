<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Addresses\International;

/**
 * Validate International Address
 *
 * ### Example
 * <code>
 *      $request = $client->addresses()->validateAddressCheckInternational();
 *      $request->setPostalCode('1000AA')
 *      $request->setCity('Plaats')
 *      $request->setStreet('Straat')
 *      $request->setHouseNumber(1)
 *      $request->setAddition('');
 *      $response = $request->send();
 *      $data = $response->getData();
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\AbstractRequest;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\Addresses\International\ValidateAddressResponse;

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
     * @return ValidateAddressRequest
     */
    public function setPostalCode(string $postalCode)
    {
        return $this->setParameter('postal_code', $postalCode);
    }

    /**
     * Get City
     * City of the address
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->getParameter('city');
    }

    /**
     * Set City
     * City of the address
     * @param string $city
     * @return ValidateAddressRequest
     */
    public function setCity(string $city)
    {
        return $this->setParameter('city', $city);
    }

    /**
     * Get Street
     * The streetname of the delivery address
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->getParameter('street');
    }

    /**
     * Set Street
     * The streetname of the delivery address
     * @param string $street
     * @return ValidateAddressRequest
     */
    public function setStreet(string $street)
    {
        return $this->setParameter('street', $street);
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
     * @return ValidateAddressRequest
     */
    public function setHouseNumber(int $houseNumber)
    {
        return $this->setParameter('house_number', $houseNumber);
    }

    /**
     * Get Addition
     * Housenumber extension
     * @return string|null
     */
    public function getAddition(): ?string
    {
        return $this->getParameter('addition');
    }

    /**
     * Set Addition
     * Housenumber extension
     * @param string $addition
     * @return ValidateAddressRequest
     */
    public function setAddition(string $addition)
    {
        return $this->setParameter('addition', $addition);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $data = [
            'PostalCode' => $this->getPostalCode(),
            'City' => $this->getCity(),
            'Street' => $this->getStreet(),
            'HouseNumber' => $this->getHouseNumber(),
            'Addition' => $this->getAddition()
        ];
        return array_filter($data);
    }

    /**
     * Send data
     * @param array $data
     * @return ValidateAddressResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendData(array $data = [])
    {
        $response = $this->client->request(
            'POST',
            '/address/national/v1/validate',
            [
                'body' => json_encode($data),
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]
        );
        return $this->response = new ValidateAddressResponse($this, $response->getBody()->json());
    }
}
