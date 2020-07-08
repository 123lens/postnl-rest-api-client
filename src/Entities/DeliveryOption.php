<?php
namespace Budgetlens\PostNLApi\Entities;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

/**
 * Delivery Option Entity
 * Class DeliveryOption
 * @package Budgetlens\PostNLApi\Entities
 */

class DeliveryOption extends AbstractEntity implements EntityInterface
{
    public $code;

    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->code = $data;
    }
}
