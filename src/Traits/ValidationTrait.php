<?php
namespace Budgetlens\PostNLApi\Traits;
/**
 * Validation helper trait
 * Class ValidationTrait
 * @package Budgetlens\PostNLApi\Traits
 */

trait ValidationTrait
{
    public function validateLength($value, int $length): void
    {
        if (is_string($value)) {
            if (strlen($value) > $length) {
                throw new \InvalidArgumentException("'{$value}' exceeds limit of '{$length}'");
            }
        }
        if (is_array($value)) {
            if (count($value) > $length) {
                throw new \InvalidArgumentException(
                    "Array length '" . count($value) . "' exceeds limit of '{$length}'"
                );
            }
        }
    }
}
