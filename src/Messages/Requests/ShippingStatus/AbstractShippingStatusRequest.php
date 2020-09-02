<?php
namespace Budgetlens\PostNLApi\Messages\Requests\ShippingStatus;

/**
 * Abstract Shipping Status Request
 *
 */
use Budgetlens\PostNLApi\Messages\Requests\AbstractRequest;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;

abstract class AbstractShippingStatusRequest extends AbstractRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Detail
     * @return bool
     */
    public function getDetail(): bool
    {
        return (bool)$this->getParameter('detail') ?? false;
    }

    /**
     * Set Detail
     * @param bool $flag
     * @return $this
     */
    public function setDetail(bool $flag)
    {
        return $this->setParameter('detail', $flag);
    }

    /**
     * Get Language
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->getParameter('language') ?? '';
    }

    /**
     * Set Language
     * @param string $language
     * @return $this
     */
    public function setLanguage(string $language)
    {
        return $this->setParameter('language', $language);
    }

    /**
     * Get Max days
     * @return int|null
     */
    public function getMaxDays(): ?int
    {
        $days = $this->getParameter('max_days');
        return ($days > 0)
            ? $days
            : null;
    }

    /**
     * Set Max Days
     * @param int $days
     * @return $this
     */
    public function setMaxDays(int $days)
    {
        return $this->setParameter('max_days', $days);
    }
}
