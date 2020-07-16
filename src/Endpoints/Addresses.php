<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Addresses Endpoint
 * @see https://developer.postnl.nl/browse-apis/addresses/
 * Class Addresses
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Addresses extends AbstractEndpoint
{
    public function validateAddressCheckNational(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Addresses\National\ValidateAddressRequest',
            $data
        );
    }
//
//    public function getAddressByPostalcodeAndHouseNumber(string $postalCode, string $houseNumber)
//    {
//        $response = $this->client->get('/address/sequence/v1/postalcode', [
//            'postalcode' => $postalCode,
//            'housenumber' => $houseNumber
//        ]);
//        print_r($response->getBody()->json());
//        exit;
//    }
}
