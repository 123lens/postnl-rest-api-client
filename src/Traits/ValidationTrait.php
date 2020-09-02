<?php
namespace Budgetlens\PostNLApi\Traits;

/**
 * Validation helper trait
 * Class ValidationTrait
 * @package Budgetlens\PostNLApi\Traits
 */

trait ValidationTrait
{
    /**
     * Validate correct format
     * @param $value
     */
    public function isTime($value, ?string $field = null): void
    {
        if (!preg_match("/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/", $value)) {
            throw new \InvalidArgumentException("{$field} invalid format, time format is: HH:ii:ss");
        }
    }

    /**
     * Validate length of string or count of array
     * @param $value
     * @param int $length
     */
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

    /**
     * Validate option against array of available options
     * @param $option
     * @param array $availableOptions
     */
    public function validOption($option, array $availableOptions): void
    {
        if (!in_array($option, $availableOptions)) {
            throw new \InvalidArgumentException(
                "{$option} is not a valid option, valid options are: " . implode(",", $availableOptions)
            );
        }
    }
}
