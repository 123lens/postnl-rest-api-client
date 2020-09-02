<?php
namespace Budgetlens\PostNLApi\Messages\Requests\Labelling;

/**
 * Confirm Shipment Request
 *
 * ### Example
 * <code>
 *      $request = $client->confirming()->confirm();
 *      $request->setPrinter('GraphicFile|PDF');
 *      $request->setCustomer((new Customer())
 *          ->setAddress((new Address())
 *              ->setAddressType(Address::SENDER)
 *              ->setCompanyName('Sender CompanyName')
 *              ->setFirstName('Frank')
 *              ->setName('Peeters')
 *              ->setCity('Hoofddorp')
 *              ->setCountryCode("NL")
 *              ->setHouseNr(42)
 *              ->setHouseNrExt('A')
 *              ->setZipcode('2132WT')
 *              ->setStreet('Siriusdreef')
 *          )
 *          ->setCollectionLocation(getenv('COLLECTION_LOCATION'))
 *          ->setCustomerCode(getenv('CUSTOMER_CODE'))
 *          ->setCustomerNumber(getenv('CUSTOMER_NUMBER'))
 *          ->setEmail('some@email.nl');
 *      );
 *      $request->addShipment((new Shipment())
 *          ->addAddress((new Address())
 *              ->setAddressType(Address::RECEIVER)
 *              ->setFirstName('Peter')
 *              ->setName('de Ruiter')
 *              ->setZipcode('3532VA')
 *              ->setStreet('Bilderdijkstraat')
 *              ->setHouseNr(9)
 *              ->setHouseNrExt('a bis')
 *              ->setCity('Utrecht')
 *              ->setCountryCode("NL")
 *          )
 *          ->setBarcode('3SDEVC6659149')
 *          ->addContact((new Shipment\Contact())
 *              ->setEmail('info@email.nl')
 *              ->setContactType('01')
 *              ->setSMSNr('0612345678')
 *          )
 *          ->setDeliveryAddress('01')
 *          ->setDimension((new Shipment\Dimension())
 *              ->setWeight(450)
 *          )
 *          ->setProductCodeDelivery(3085)
 *          ->setRemark('Remark')
 *      );
 *      $response = $request->send();
 * </code>
 */

use Budgetlens\PostNLApi\Entities\Customer;
use Budgetlens\PostNLApi\Entities\Shipment;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\MessageInterface;
use Budgetlens\PostNLApi\Messages\Requests\Contracts\RequestInterface;
use Budgetlens\PostNLApi\Messages\Responses\Labelling\ConfirmResponse;

class ConfirmRequest extends AbstractLabellingRequest implements RequestInterface, MessageInterface
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
        $shipments =  $this->getParameter('shipments');
        return is_array($shipments)
            ? $shipments
            : [];
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
     * Get Confirm Flag.
     * Confirms shipment at postnl on label request
     * If this value is false you need to manually confirm each shipment @ postnl
     * @return bool
     */
    public function getConfirm(): bool
    {
        return (bool)$this->getParameter('confirm');
    }

    /**
     * Set Confirm Flag
     * Confirms shipment at postnl on label request
     * If this value is false you need to manually confirm each shipment @ postnl
     * @param bool $flag
     * @return GenerateLabelRequest
     */
    public function setConfirm(bool $flag)
    {
        return $this->setParameter('confirm', $flag);
    }

    /**
     * Get Data
     * @return array
     */
    public function getData(): array
    {
        $this->validate(
            'customer',
            'printer',
            'shipments'
        );
        $shipments = [];
        foreach ($this->getShipments() as $shipment) {
            $shipments[] = $shipment->toArray();
        }
        $data = [
            'Message' => $this->getMessage()->toArray(),
            'Customer' => $this->getCustomer()->toArray(),
            'Shipments' => $shipments[0]
        ];
        return array_filter($data);
    }

    public function sendData(array $data = [])
    {
        $response = $this->client->request(
            'POST',
            '/shipment/v2/confirm',
            [
                'body' => json_encode($data),
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]
        );
        return $this->response = new ConfirmResponse($this, $response->getBody()->json());
    }
}
