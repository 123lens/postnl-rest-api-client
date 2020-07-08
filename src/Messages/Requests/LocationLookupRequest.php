<?php
namespace Budgetlens\PostNLApi\Messages\Requests;

/**
 * Nearest Locations Request
 *
 * ### Example
 * <code>
 *      $request = $client->locations()->locationLookup();
 *      $request->setLocationCode('173187');
 *      $request->setRetailNetworkID('PNPNL-01');
 *      $response = $request->send();
 *      $location = $response->getLocation();
 * </code>
 *
 */
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\LocationLookupResponse;
use Budgetlens\PostNLApi\Messages\Responses\NearestLocationsResponse;

class LocationLookupRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Location Code
     * @return string|null
     */
    public function getLocationCode(): ?string
    {
        return $this->getParameter('location_code');
    }

    /**
     * Set Location Code
     * @param string $locationCode
     * @return LocationLookupRequest
     */
    public function setLocationCode(string $locationCode)
    {
        return $this->setParameter('location_code', $locationCode);
    }

    /**
     * Get Retail Network ID
     * @return string|null
     */
    public function getRetailNetworkID(): ?string
    {
        return $this->getParameter('retail_network_id');
    }

    /**
     * Set Retail Network ID
     * @param string $id
     * @return LocationLookupRequest
     */
    public function setRetailNetworkID(string $id)
    {
        return $this->setParameter('retail_network_id', $id);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'location_code',
            'retail_network_id'
        );

        $data = [
            'LocationCode' => $this->getLocationCode(),
            'RetailNetworkID' => $this->getRetailNetworkID()
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
            '/shipment/v2_1/locations/lookup',
            [
                'query' => $data
            ]
        );

        return $this->response = new LocationLookupResponse($this, $response->getBody()->json());
    }
}
