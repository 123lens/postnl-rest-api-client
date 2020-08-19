<?php
namespace Budgetlens\PostNLApi\Entities\Shipment;

/**
 * HazardousMaterial Entity
 * Class HazardousMaterial
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\AbstractEntity;
use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;
use Budgetlens\PostNLApi\Entities\Shipment\Customs\Item;
use Budgetlens\PostNLApi\Traits\ValidationTrait;

class HazardousMaterial extends AbstractEntity implements EntityInterface
{
    use ValidationTrait;

    public $ToxicSubstanceCode;
    public $AdditionalToxicSubstanceCode;
    public $ADRPoints;
    public $TunnelCode;
    public $PackagingGroupCode;
    public $PackagingGroupDescription;
    public $GrossWeight;
    public $UNDGNumber;
    public $TransportCategoryCode;
    public $ChemicalTechnicalDescription;

    /**
     * Get Toxic Substance Code
     *
     * @return string|null
     */
    public function getToxicSubstanceCode(): ?string
    {
        return $this->ToxicSubstanceCode;
    }

    /**
     * Set Toxic Substance Code
     * @param string $code
     * @return $this
     */
    public function setToxicSubstanceCode(string $code)
    {
        $this->ToxicSubstanceCode = $code;
        return $this;
    }

    /**
     * Get Additional Toxic Substance Code
     * @return string|null
     */
    public function getAdditionalToxicSubstanceCode(): ?string
    {
        return $this->AdditionalToxicSubstanceCode;
    }

    /**
     * Set Additional Toxic Substance Code
     * @param string $additionalToxicSubstanceCode
     * @return $this
     */
    public function setAdditionalToxicSubstanceCode(string $additionalToxicSubstanceCode)
    {
        $this->AdditionalToxicSubstanceCode = $additionalToxicSubstanceCode;
        return $this;
    }

    /**
     * Get ADR Points
     * @return string|null
     */
    public function getADRPoints(): ?string
    {
        return $this->ADRPoints;
    }

    /**
     * Set ADR Points
     * @param string $adrPoints
     * @return $this
     */
    public function setADRPoints(string $adrPoints)
    {
        $this->ADRPoints = $adrPoints;
        return $this;
    }

    /**
     * Get Tunnel Code
     * @return string|null
     */
    public function getTunnelCode(): ?string
    {
        return $this->TunnelCode;
    }

    /**
     * Set Tunnel Code
     * @param string $tunnelCode
     * @return $this
     */
    public function setTunnelCode(string $tunnelCode)
    {
        $this->TunnelCode = $tunnelCode;
        return $this;
    }

    /**
     * Get Packaging Group Code
     * @return string|null
     */
    public function getPackagingGroupCode(): ?string
    {
        return $this->PackagingGroupCode;
    }

    /**
     * Set Packaging Group Code
     * @param string $packagingGroupCode
     * @return $this
     */
    public function setPackagingGroupCode(string $packagingGroupCode)
    {
        $this->PackagingGroupCode = $packagingGroupCode;
        return $this;
    }

    /**
     * Get Packaging Group Description
     * @return string|null
     */
    public function getPackagingGroupDescription(): ?string
    {
        return $this->PackagingGroupDescription;
    }

    /**
     * Set Packaging Group Description
     * @param string $packagingGroupDescription
     * @return $this
     */
    public function setPackagingGroupDescription(string $packagingGroupDescription)
    {
        $this->PackagingGroupDescription = $packagingGroupDescription;
        return $this;
    }

    /**
     * Get Gross Weight
     * @return string|null
     */
    public function getGrossWeight(): ?string
    {
        return $this->GrossWeight;
    }

    /**
     * Set Gross Weight
     * @param string $grossWeight
     * @return $this
     */
    public function setGrossWeight(string $grossWeight)
    {
        $this->GrossWeight = $grossWeight;
        return $this;
    }

    /**
     * Get UNDG Number
     * @return string|null
     */
    public function getUNDGNumber(): ?string
    {
        return $this->UNDGNumber;
    }

    /**
     * Set UNDG Number
     * @param string $undgNumber
     * @return $this
     */
    public function setUNDGNumber(string $undgNumber)
    {
        $this->UNDGNumber = $undgNumber;
        return $this;
    }

    /**
     * Get Transport Category Code
     * @return string|null
     */
    public function getTransportCategoryCode(): ?string
    {
        return $this->TransportCategoryCode;
    }

    /**
     * Set Transport Category Code
     * @param string $transportCategoryCode
     * @return $this
     */
    public function setTransportCategoryCode(string $transportCategoryCode)
    {
        $this->TransportCategoryCode = $transportCategoryCode;
        return $this;
    }

    /**
     * Get Chemical Technical Description
     * @return string|null
     */
    public function getChemicalTechnicalDescription(): ?string
    {
        return $this->ChemicalTechnicalDescription;
    }

    /**
     * Set Chemical Technical Description
     * @param string $chemicalTechnicalDescription
     * @return $this
     */
    public function setChemicalTechnicalDescription(string $chemicalTechnicalDescription)
    {
        $this->ChemicalTechnicalDescription = $chemicalTechnicalDescription;
        return $this;
    }
}
