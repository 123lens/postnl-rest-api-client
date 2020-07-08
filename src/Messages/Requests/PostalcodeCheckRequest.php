<?php
namespace Budgetlens\PostNLApi\Messages\Requests;

/**
 * Postalcode Check Request
 *
 * ### Example
 * <code>
 *      $request = $client->locations()->nearestLocations();
 *      $request->setCountryCode('NL')
 *      $request->setPostalcode('1000AA')
 *      $request->setDeliveryOptions(['PG']);
 *      $response = $request->send();
 *      $locations = $response->getLocations();
 * </code>
 *
 */
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;
use Budgetlens\PostNLApi\Messages\Responses\PostalcodeCheckResponse;

class PostalcodeCheckRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Postalcode
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->getParameter('postal_code');
    }

    /**
     * Set Postalcode
     * @param string $postalcode
     * @return NearestLocationsRequest
     */
    public function setPostalCode(string $postalcode)
    {
        return $this->setParameter('postal_code', $postalcode);
    }


    /**
     * Get House Number
     * @return int|null
     */
    public function getHouseNumber(): ?int
    {
        return $this->getParameter('house_number');
    }

    /**
     * Set House Number
     * @param int $houseNumber
     */
    public function setHouseNumber(int $houseNumber)
    {
        $this->setParameter('house_number', $houseNumber);
    }

    /**
     * Get HouseNumber Addition
     * @return string|null
     */
    public function getHouseNumberAddition(): ?string
    {
        return $this->getParameter('house_number_addition');
    }

    /**
     * Set HouseNumber Addition
     * @param string $addition
     * @return NearestLocationsRequest
     */
    public function setHouseNumberAddition(string $addition)
    {
        return $this->setParameter('house_number_addition', $addition);
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
            'housenumber' => $this->getHouseNumber(),
            'housenumberaddition' => $this->getHouseNumberAddition()
        ];
        return array_filter($data);
    }

    /**
     * Send data
     * @param array $data
     * @return NearestLocationsResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendData(array $data = [])
    {
        $response = $this->client->request(
            'GET',
            '/shipment/checkout/v1/postalcodecheck',
            [
                'query' => $data
            ]
        );
        return $this->response = new PostalcodeCheckResponse($this, $response->getBody()->json());
    }
}
