<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Barcode;

/**
 * Generate Global Pack Barcode Request
 *
 * ### Example
 * <code>
 *      $request = $client->barcode()->generateBarcodeGlobalPack();
 *      $request->setCustomerCode('--CUSTOMER_CODE--');
 *      $request->setCustomerNumber('--CUSTOMER_NUMBER--');
 *      $request->setType('CD');
 *      $request->setRange('--GLOBAL_PACK_CODE--');
 *      $response = $request->send();
 *      $barcode = $response->getBarcode();
 * </code>
 *
 */

use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;

class GenerateBarcodeGlobalPackRequest extends AbstractGenerateBarcodeRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'customer_code',
            'customer_number',
            'type',
            'range'
        );
        // define serie.
        $this->setSerie(self::GLOBAL_BARCODE_SERIE);
        return parent::getData();
    }
}
