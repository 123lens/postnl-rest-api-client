<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Delivery Option Entity
 * Class DeliveryOption
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class DeliveryOption extends AbstractEntity implements EntityInterface
{
    public $code;

    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->code = $data;
    }
}
