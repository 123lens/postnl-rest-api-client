<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Entities\Company;
use Budgetlens\PostNLApi\Messages\Responses\Company\SearchByPhonenumberResponse;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * @test
     */
    public function searchCompanyByPhonenumber()
    {
        $request = $this->getClient('Company/companySearchSuccess.json')->company()->companySearchByPhonenumber();
        $request->setPhonenumber('0182586601');
        $response = $request->send();
        $this->assertInstanceOf(SearchByPhonenumberResponse::class, $response);
        $this->assertIsArray($response->getData());
        $this->assertSame(1, $response->getTotalPages());
        $this->assertSame(1, $response->getResultCount());
        $this->assertIsArray($response->getResults());
        $this->assertInstanceOf(Company::class, $response->getResults()[0]);
        $this->assertSame('123456', $response->getResults()[0]->getKvkNumber());
    }
}

