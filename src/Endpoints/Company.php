<?php
namespace Budgetlens\PostNLApi\Endpoints;

/**
 * Company Endpoint
 * @see https://developer.postnl.nl/browse-apis/customer-overview/
 * Class Addresses
 * @package Budgetlens\PostNLApi\Endpoints
 */

class Company extends AbstractEndpoint
{
    /**
     * Search company by phonenumber
     * https://developer.postnl.nl/browse-apis/customer-overview/bedrijfscheck-nationaal/
     * @param array $data
     * @return mixed
     */
    public function companySearchByPhonenumber(array $data = [])
    {
        return $this->createRequest(
            'Budgetlens\PostNLApi\Messages\Requests\Company\SearchByPhonenumberRequest',
            $data
        );
    }
}
