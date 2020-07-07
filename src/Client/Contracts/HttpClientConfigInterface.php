<?php
namespace Budgetlens\PostNLApi\Client\Contracts;

/**
 * Contract for Http Client Config
 *
 * Interface HttpClientConfigInterface
 * @package Budgetlens\PostNLApi\Client\Contracts
 */
interface HttpClientConfigInterface
{
    public function getApiKey(): string;
    public function getApiUrl(): string;
    public function getConnectionTimeout(): int;
}
