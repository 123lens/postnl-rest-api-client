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
    /**
     * Validate Address Check National
     * https://developer.postnl.nl/browse-apis/addresses/adrescheck-nationaal/
     * @param array $data
     * @return mixed
     */
    public function validateAddressCheckNational(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Addresses\National\ValidateAddressRequest',
            $data
        );
    }

    /**
     * Validate Adress Check International
     * https://developer.postnl.nl/browse-apis/addresses/adrescheck-internationaal/
     * @param array $data
     * @return mixed
     */
    public function validateAddressCheckInternational(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Addresses\International\ValidateAddressRequest',
            $data
        );
    }

    /**
     * Geo Address Check National
     * @see https://developer.postnl.nl/browse-apis/addresses/geo-adrescheck-nationaal/
     * @param array $data
     * @return mixed
     */
    public function geoAddressCheckNational(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Addresses\Geo\AddressCheckRequest',
            $data
        );
    }

    /**
     * Validate Address Check Basic National
     * @see https://developer.postnl.nl/browse-apis/addresses/adrescheck-basis-nationaal/
     * @param array $data
     * @return mixed
     */
    public function validateAddressCheckBasicNational(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Addresses\Basic\ValidateAddressRequest',
            $data
        );
    }
}
