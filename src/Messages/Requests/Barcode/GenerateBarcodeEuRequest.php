<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Barcode;

/**
 * Generate EU Barcode Request
 *
 * ### Example
 * <code>
 *      $request = $client->barcode()->generateBarcodeEu();
 *      $request->setCustomerCode('--CUSTOMER_CODE--');
 *      $request->setCustomerNumber('--CUSTOMER_NUMBER--');
 *      $response = $request->send();
 *      $barcode = $response->getBarcode();
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;

class GenerateBarcodeEuRequest extends AbstractGenerateBarcodeRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'customer_code',
            'customer_number'
        );
        $this->setType('3S');
        // define serie.
        if (strlen($this->getCustomerCode()) > 3) {
            $this->setSerie(self::EU_BARCODE_SERIE_SHORT);
        } else {
            $this->setSerie(self::EU_BARCODE_SERIE_LONG);
        }
        return parent::getData();
    }
}
