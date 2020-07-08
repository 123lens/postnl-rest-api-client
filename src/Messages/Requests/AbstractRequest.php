<?php
namespace Budgetlens\PostNLApi\Messages\Requests;

use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;
use Budgetlens\PostNLApi\Traits\ParametersTrait;
use Budgetlens\PostNLApi\Util\Helper;
use Budgetlens\PostNLApi\Util\ParameterBag;
use GuzzleHttp\ClientInterface;


/**
 * Abstract Message Request
 * Class AbstractRequest
 * @package Budgetlens\PostNLApi\Messages\Requests
 */

abstract class AbstractRequest implements RequestInterface
{
    use ParametersTrait;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Initialize object with parameters
     * @param array $parameters
     * @return $this
     */
    public function initialize(array $parameters = [])
    {
        $this->parameters = new ParameterBag();
        Helper::initialize($this, $parameters);
        return $this;
    }

    /**
     * Send request
     * @return mixed
     */
    public function send()
    {
        $data = $this->getData();
        return $this->sendData($data);
    }

    /**
     * Get Response
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
