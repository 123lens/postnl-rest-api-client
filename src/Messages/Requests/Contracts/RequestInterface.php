<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Contracts;

/**
 * Request Interface
 * Class RequestInterface
 * @package Budgetlens\PostNLApi\Messages\Requests\Contracts
 */

interface RequestInterface
{
    public function initialize(array $array = []);
    public function send();
    public function sendData(array $data = []);
}
