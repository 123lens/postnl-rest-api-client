<?php
namespace Budgetlens\PostNLApi\Messages\Responses;

use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

/**
 * Abstract Response
 *
 * Class AbstractResponse
 * @package Budgetlens\PostNLApi\Messages\Responses\Contracts
 */

abstract class AbstractResponse implements ResponseInterface
{
    protected $request;

    protected $data;

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    /**
     * Get Request
     * @return RequestInterface|mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get Response Data
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
