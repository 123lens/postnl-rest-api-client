<?php
namespace Budgetlens\PostNLApi\Messages\Responses\Barcode;

/**
 * Barcode Response
 */

use Budgetlens\PostNLApi\Messages\Responses\AbstractResponse;
use Budgetlens\PostNLApi\Messages\Responses\Contracts\ResponseInterface;

class GenerateBarcodeResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * Get Barcode
     * @return string
     */
    public function getBarcode()
    {
        $data = $this->getData();
        return $data['Barcode'] ?? null;
    }
}
