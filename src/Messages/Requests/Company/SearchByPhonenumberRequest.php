<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Company;

/**
 * Nearest Locations Request
 *
 * ### Example
 * <code>
 *      $request = $client->company()->companySearchByPhonenumber();
 *      $request->setLocationCode('173187');
 *      $request->setRetailNetworkID('PNPNL-01');
 *      $response = $request->send();
 *      $location = $response->getLocation();
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\AbstractRequest;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\Company\SearchByPhonenumberResponse;

class SearchByPhonenumberRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Phonenumber
     * @return string|null
     */
    public function getPhonenumber(): ?string
    {
        return $this->getParameter('phonenumber');
    }

    /**
     * Set Phonenumber
     * @param string $phonenumber
     * @return SearchByPhonenumberRequest
     */
    public function setPhonenumber(string $phonenumber)
    {
        return $this->setParameter('phonenumber', $phonenumber);
    }

    /**
     * Get Include Main Branch
     * @return int
     */
    public function getIncludeMainBranch(): int
    {
        return (int)$this->getParameter('main_branch');
    }

    /**
     * Set Include Main Branch
     * @param int $include
     * @return SearchByPhonenumberRequest
     */
    public function setIncludeMainBranch(int $include)
    {
        return $this->setParameter('main_branch', $include);
    }

    /**
     * Get Include branch
     * @return int
     */
    public function getIncludeBranch(): int
    {
        return (int)$this->getParameter('branch');
    }

    /**
     * Set Include Branch
     * @param int $include
     * @return SearchByPhonenumberRequest
     */
    public function setIncludeBranch(int $include)
    {
        return $this->setParameter('branch', $include);
    }

    /**
     * Get Include Inactive
     * @return int
     */
    public function getIncludeInactive(): int
    {
        return (int)$this->getParameter('include_inactive');
    }

    /**
     * Set Include Inactive
     * @param int $include
     * @return SearchByPhonenumberRequest
     */
    public function setIncludeInactive(int $include)
    {
        return $this->setParameter('include_inactive', $include);
    }

    /**
     * Get max results per page
     * @return int|null
     */
    public function getMaxResultsPerPage(): ?int
    {
        return $this->getParameter('max_results_per_page');
    }

    /**
     * Set Max Results Per Page
     * @param int $max
     */
    public function setMaxResultsPerPage(int $max)
    {
        $this->setParameter('max_results_per_page', $max);
    }

    /**
     * Get Requested Page
     * @return int|null
     */
    public function getRequestedPage(): ?int
    {
        return $this->getParameter('requested_page');
    }

    /**
     * Set Requested Page
     * @param int $page
     * @return SearchByPhonenumberRequest
     */
    public function setRequestedPage(int $page)
    {
        return $this->setParameter('requested_page');
    }
    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'phonenumber'
        );

        $data = [
            'phonenumber' => $this->getPhonenumber(),
            'mainbranch' => $this->getIncludeMainBranch(),
            'branch' => $this->getIncludeBranch(),
            'includeinactive' => $this->getIncludeInactive(),
            'maxresultsperpage' => $this->getMaxResultsPerPage(),
            'requestedpage' => $this->getRequestedPage()
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
            '/company/search/v3/phonenumber',
            [
                'query' => $data
            ]
        );
        return $this->response = new SearchByPhonenumberResponse($this, $response->getBody()->json());
    }
}
