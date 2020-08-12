<?php
namespace Budgetlens\PostNLApi\Entities\Shipment;

/**
 * Group Entity
 * Class Contact
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Entities\Shipment\Customs\Item;
use Budgetlens\PostNLApi\Traits\ValidationTrait;

class Group extends AbstractEntity implements EntityInterface
{
    use ValidationTrait;

    private $GroupType;
    private $GroupSequence;
    private $GroupCount;
    private $MainBarcode;

    /**
     * Get Group Type
     * Group sort that determines the type of group that is indicated. This is a code.
     * Possible values:
     *      01 = Collection request
     *      03 = Multiple parcels in one shipment (multicolli)
     *      04 = Single parcel in one shipment
     * @return string|null
     */
    public function getGroupType(): ?string
    {
        return $this->GroupType;
    }

    /**
     * Set Group Type
     * Group sort that determines the type of group that is indicated. This is a code.
     * Possible values:
     *      01 = Collection request
     *      03 = Multiple parcels in one shipment (multicolli)
     *      04 = Single parcel in one shipment
     * @param string $groupType
     * @return $this
     */
    public function setGroupType(string $groupType)
    {
        $this->GroupType = $groupType;
        return $this;
    }

    /**
     * Get Group Sequence
     * Sequence number of the collo within the complete shipment (e.g. collo 2 of 4)
     * Mandatory for multicollo shipments
     * @return string|null
     */
    public function getGroupSequence(): ?string
    {
        return $this->GroupSequence;
    }

    /**
     * Set Group Sequence
     * Sequence number of the collo within the complete shipment (e.g. collo 2 of 4)
     * Mandatory for multicollo shipments
     * @param string $groupSequence
     * @return $this
     */
    public function setGroupSequence(string $groupSequence)
    {
        $this->GroupSequence = $groupSequence;
        return $this;
    }

    /**
     * Get Group Count
     * Total number of colli in the shipment (in case of multicolli shipments)
     * Mandatory for multicollo shipments
     * @return int|null
     */
    public function getGroupCount(): ?int
    {
        return $this->GroupCount;
    }

    /**
     * Set Group Count
     * Total number of colli in the shipment (in case of multicolli shipments)
     * Mandatory for multicollo shipments
     * @param int $cnt
     * @return $this
     */
    public function setGroupCount(int $cnt)
    {
        $this->GroupCount = $cnt;
        return $this;
    }

    /**
     * Get Mainbarcode
     * Main barcode for the shipment (in case of multicolli shipments)
     * Mandatory for multicollo shipments
     * @return string|null
     */
    public function getMainBarcode(): ?string
    {
        return $this->MainBarcode;
    }

    /**
     * Set Main Barcode
     * Main barcode for the shipment (in case of multicolli shipments)
     * Mandatory for multicollo shipments
     * @param string $mainBarcode
     * @return $this
     */
    public function setMainBarcode(string $mainBarcode)
    {
        $this->MainBarcode = $mainBarcode;
        return $this;
    }
}
