<?php
namespace Budgetlens\PostNLApi\Messages\Responses\Contracts;

/**
 * Response interface
 * Class ResponseInterface
 * @package Budgetlens\PostNLApi\Messages\Responses\Contracts
 */

interface ResponseInterface
{
    /**
     * Get the original request which generated this response
     * @return mixed
     */
    public function getRequest();

}
