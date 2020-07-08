<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Contracts;

/**
 * Message Interface
 * Class MessageInterface
 * @package Budgetlens\PostNLApi\Messages\Requests\Contracts
 */

interface MessageInterface
{
    public function getData(): array;
}
