<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Labelling;

/**
 * Generate Domestic (Dutch) Barcode Request
 *
 * ### Example
 * <code>
 *      $request = $client->barcode()->generateBarcodeDomestic();
 *      $request->setCustomerCode('--CUSTOMER_CODE--');
 *      $request->setCustomerNumber('--CUSTOMER_NUMBER--');
 *      $response = $request->send();
 *      $barcode = $response->getBarcode();
 * </code>
 *
 */

use Budgetlens\PostNLApi\Entities\Customer;
use Budgetlens\PostNLApi\Messages\Requests\Barcode\AbstractGenerateBarcodeRequest;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;

class GenerateLabelRequest extends AbstractGenerateBarcodeRequest implements RequestInterface, MessageInterface
{
    /**
     * Get Customer
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->getParameter('customer');
    }

    /**
     * Set Customer
     * @param Customer $customer
     * @return GenerateLabelRequest
     */
    public function setCustomer(Customer $customer)
    {
        return $this->setParameter('customer', $customer);
    }

    /**
     * Get Shipments
     * @return array
     */
    public function getShipments(): array
    {
        return $this->getParameter('shipments') || [];
    }

    /**
     * Set Shipments
     * @param array $shipments
     * @return GenerateLabelRequest
     */
    public function setShipments(array $shipments)
    {
        return $this->setParameter('shipments', $shipments);
    }

    /**
     * Add Shipment
     * @param Shipment $shipment
     * @return GenerateLabelRequest
     */
    public function addShipment(Shipment $shipment)
    {
        $shipments = $this->getShipments();
        $shipments[] = $shipment;
        return $this->setShipments($shipments);
    }

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
            $this->setSerie(self::NL_BARCODE_SERIE_SHORT);
        } else {
            $this->setSerie(self::NL_BARCODE_SERIE_LONG);
        }
        return parent::getData();
    }
}
