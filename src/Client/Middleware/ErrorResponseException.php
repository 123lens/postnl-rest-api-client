<?php
namespace Budgetlens\PostNLApi\Client\Middleware;

/**
 * Error Response Exception
 * PostNL Returned a 400 error code with json formatted error body.
 * However PostNL doesn't use the same formatting for the errors.
*/

use Throwable;

class ErrorResponseException extends \Exception
{
    /**
     * @var array
     */
    protected $errors = [];

    public function __construct($message = "", $code = 0, $errors = [])
    {
        parent::__construct($message, $code);
        $this->setErrors($errors);
    }

    /**
     * PostNL doesn't handle 1 format for error messaging.
     * Make sure we do use the same..
     * @param array $errors
     */
    private function setErrors(array $errors = [])
    {
        if (isset($errors['Item'])) {
            $this->errors = $errors['Item'];
        } elseif (isset($errors['ErrorMsg'])) {
            $this->errors[] = $errors;
        } else {
            $this->errors = $errors;
        }
    }

    /**
     * Return errors
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
