<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Abstract Entity
 * Class AbstractEntity
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Traits\ValidationTrait;
use Budgetlens\PostNLApi\Util\Helper;

abstract class AbstractEntity implements EntityInterface
{
    use ValidationTrait;

    private $data;

    public function __construct($data = [])
    {
        if (is_array($data)) {
            $this->data = $data;
            $this->reflectionData();
        }
    }

    /**
     * Populate object data from array
     */
    protected function reflectionData(): void
    {
        $reflector = new \ReflectionClass(get_class($this));

        // Get all the properties from class A in to $properties array
        $properties = $reflector->getProperties();

        // Go through the $properties array and populate each property
        foreach ($properties as $property) {
            if (!$property->isPrivate() && !$property->isStatic()) {
                $propertyName = $property->getName();
                if (isset($this->data[$propertyName])) {
                    $this->{$propertyName} = $this->data[$propertyName];
                } else if (isset($this->data[Helper::camelCase($propertyName)])) {
                    $this->{$propertyName} = $this->data[Helper::camelCase($propertyName)];
                }

            }
        }
    }

    /**
     * Output object as array
     * @return array
     */
    public function toArray(): array
    {
        // return data placeholder
        $return = [];

        $reflector = new \ReflectionClass(get_class($this));

        // Get all the properties from class A in to $properties array
        $properties = $reflector->getProperties();

        // Go through the $properties array and populate each property
        foreach ($properties as $property) {
            if (!$property->isPrivate() && !$property->isStatic()) {
                $propertyName = $property->getName();
                if ($this->hasGetter($reflector, $propertyName)) { //use getter
                    $value = call_user_func(array($this, "get" . $propertyName));
                } else {
                    $value = $this->{$propertyName};
                }
                if (!is_null($value)) {
                    $return[$propertyName] = $value;
                }
            }
        }
        return $return;
    }


    /**
     * Check for getter method in reflection class based on propertyname
     * Eg.
     *      Property: $PublicationDate
     *      Getter: getPublicationDate
     * @param ReflectionClass $obj
     * @param string $propertyName
     * @return bool
     */
    private function hasGetter(\ReflectionClass $obj, string $propertyName): bool
    {
        try {
            $parent = $obj->getMethod("get" . ucfirst($propertyName));
            if ($parent->isPublic() || $parent->isProtected()) {
                return true;
            }
        } catch (\Exception $e) {
        }
        // getter not accessible or doesn't exists.
        return false;
    }
}
