<?php
namespace Budgetlens\PostNLApi\Messages\Responses\Company;

/**
 * Company Search By Phonenumber Response
 */

use Budgetlens\PostNLApi\Entities\Company;
use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class SearchByPhonenumberResponse extends AbstractResponse implements ResponseInterface
{
    public function getTotalPages(): ?int
    {
        $data = $this->getData();
        return $data['totalPages'] ?? null;
    }

    public function getRequestedPage(): ?int
    {
        $data = $this->getData();
        return $data['requestedPage'] ?? null;
    }

    public function getResultCount(): ?int
    {
        $data = $this->getData();
        return $data['resultCount'] ?? null;
    }

    public function getResults(): array
    {
        $data = $this->getData();
        $results = $data['results'] ?? [];
        $return = [];
        if (count($results) > 0) {
            foreach ($results as $result) {
                $return[] = (new Company())
                    ->setCompanyName($result['companyName'] ?? '')
                    ->setKvkNumber($result['kvkNumber'] ?? '')
                    ->setPostnlKey($result['postnlKey'] ?? '')
                    ->setBranchNumber($result['branchNumber'] ?? '')
                    ->setCompanyPhoneNumber($result['companyPhoneNumber'] ?? '')
                    ->setCompanyMobilePhoneNumber($result['companyMobilePhoneNumber'] ?? '')
                    ->setBranchStreetName($result['branchStreetName'] ?? '')
                    ->setBranchHouseNumber($result['branchHouseNumber'] ?? '')
                    ->setBranceHouseNumberAddition($result['branceHouseNumberAddition'] ?? '')
                    ->setBranchPostalCode($result['branchPostalCode'] ?? '')
                    ->setBranchCity($result['branchCity'] ?? '')
                    ->setMailingStreetName($result['mailingStreetName'] ?? '')
                    ->setMailingHouseNumber($result['mailingHouseNumber'] ?? '')
                    ->setMailingHouseNumberAddition($result['mailingHouseNumberAddition'] ?? '')
                    ->setMailingPostalCode($result['mailingPostalCode'] ?? '')
                    ->setMailingCity($result['mailingCity'] ?? '')
                    ->setLegalName($result['legalName'] ?? '')
                    ->setTradeNames($result['tradeNames'] ?? '');
            }
        }
        return $return;
    }
}
