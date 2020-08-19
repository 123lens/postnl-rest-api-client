<?php
namespace Budgetlens\PostNLApi\Entities;

/**
 * Message Entity
 * Class Message
 * @package Budgetlens\PostNLApi\Entities
 */

use Budgetlens\PostNLApi\Entities\Contracts\EntityInterface;

class Message extends AbstractEntity implements EntityInterface
{
    public $MessageID;
    public $MessageTimeStamp;
    public $Printertype;

    /**
     * Get Message ID
     * @return int
     */
    public function getMessageId()
    {
        return !is_null($this->MessageID)
            ? $this->MessageID
            : 1;
    }

    /**
     * Set Message ID
     * @param int $id
     * @return $this
     */
    public function setMessageId(int $id)
    {
        $this->MessageID = $id;
        return $this;
    }

    /**
     * Get Message Timestamp
     * @return string
     */
    public function getMessageTimestamp()
    {
        $timeStamp = $this->MessageTimeStamp;
        if (is_null($timeStamp)) {
            $timeStamp = new \DateTime();
        }
        return $timeStamp->format('d-m-Y H:i:s');
    }

    /**
     * Set Message Timestamp
     * @param \DateTime $timestamp
     * @return $this
     */
    public function setMessageTimestamp(\DateTime $timestamp)
    {
        $this->MessageTimeStamp = $timestamp;
        return $this;
    }

    /**
     * Get Printer Type
     * @return string|null
     */
    public function getPrinterType(): ?string
    {
        return $this->Printertype;
    }
    /**
     * Set PrinterType
     * @return string
     */
    public function setPrinterType(string $printerType)
    {
        $this->Printertype = $printerType;
        return $this;
    }
}
