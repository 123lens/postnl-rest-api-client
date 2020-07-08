<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Locations Endpoint
 * @see https://developer.postnl.nl/browse-apis/delivery-options/
 * Class Addresses
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Locations extends AbstractEndpoint
{
    public function nearestLocations(array $data = [])
    {
        return $this->createRequest('Budgetlens\PostNLApi\Messages\Requests\NearestLocationsRequest');
    }

//
//    public function getNearestLocations(
//        string $postalCode,
//        string $countryCode = "NL",
//        array $deliveryOptions = ['PG'],
//        string $street = null,
//        int $houseNumber = null,
//        \DateTime $deliveryDate = null,
//        \DateTime $openingTime = null
//    ) {
//        $response = $this->client->get('')
//        $response = $this->client->get('/address/sequence/v1/postalcode', [
//            'postalcode' => $postalCode,
//            'housenumber' => $houseNumber
//        ]);
//        print_r($response->getBody()->json());
//        exit;
//    }
}
