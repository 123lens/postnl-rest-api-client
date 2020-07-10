<?php
namespace Budgetlens\PostNLApi\Client\Middleware;


use Throwable;

class ErrorResponseException extends \Exception
{
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
    public function getErrors()
    {
        return $this->errors;
    }
}
