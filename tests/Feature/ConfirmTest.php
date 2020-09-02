<?php
namespace Tests\Feature;

use Budgetlens\PostNLApi\Entities\Address;
use Budgetlens\PostNLApi\Entities\Customer;
use Budgetlens\PostNLApi\Entities\Shipment;
use Budgetlens\PostNLApi\Messages\Responses\Labelling\ConfirmResponse;
use Tests\TestCase;
use Faker\Factory;

class ConfirmTest extends TestCase
{
    // mostly used in tests
    const PRODUCT_CODE = "3085";
    const REMARK = "UNIT TEST";

    /**
     * @test
     */
    public function ConfirmShipmentSuccess()
    {
        $barcode = '3STBJG243556367';
        $customer = $this->getCustomerEntity();

        $request = $this->getClient('Confirming/ConfirmShipmentSuccess.json')->confirming()->confirm();
        $request->setPrinter('GraphicFile|PDF');
        $request->setCustomer($customer);
        $request->addShipment((new Shipment())
            ->addAddress((new Address())
                ->setAddressType(Address::RECEIVER)
                ->setFirstName('Peter')
                ->setName('de Ruiter')
                ->setZipcode('3532VA')
                ->setStreet('Bilderdijkstraat')
                ->setHouseNr(9)
                ->setHouseNrExt('a bis')
                ->setCity('Utrecht')
                ->setCountryCode("NL")
            )
            ->setBarcode($barcode)
            ->addContact($this->getContactEntity())
            ->setDeliveryAddress('01')
            ->setDimension($this->getDimensionEntity())
            ->setProductCodeDelivery(self::PRODUCT_CODE)
            ->setRemark(self::REMARK)
        );
        $response = $request->send();

        $this->assertInstanceOf(ConfirmResponse::class, $response);
        $this->assertIsArray($response->getResponseShipments());
        $this->assertSame($barcode, $response->getResponseShipments()[0]['Barcode']);
    }

    private function getCustomerEntity()
    {
        return (new Customer())
            ->setAddress((new Address())
                ->setAddressType(Address::SENDER)
                ->setCompanyName('Sender CompanyName')
                ->setFirstName('Frank')
                ->setName('Peeters')
                ->setCity('Hoofddorp')
                ->setCountryCode("NL")
                ->setHouseNr(42)
                ->setHouseNrExt('A')
                ->setZipcode('2132WT')
                ->setStreet('Siriusdreef')
            )
            ->setCollectionLocation(getenv('COLLECTION_LOCATION'))
            ->setCustomerCode(getenv('CUSTOMER_CODE'))
            ->setCustomerNumber(getenv('CUSTOMER_NUMBER'))
            ->setEmail('some@email.nl');
    }

    private function getContactEntity()
    {
        $faker = Factory::create('nl_NL');
        return (new Shipment\Contact())
            ->setEmail($faker->email)
            ->setContactType('01')
            ->setSMSNr('0612345678');
    }

    public function getDimensionEntity(array $params = [])
    {
        $weight = $params['weight'] ?? null;
        $volume = $params['volume'] ?? null;
        $height = $params['height'] ?? null;
        $length = $params['length'] ?? null;
        $width = $params['width'] ?? null;

        $dimension = (new Shipment\Dimension())
            ->setWeight($params['weight'] ?? 450);
        if (!is_null($volume)) {
            $dimension->setVolume($volume);
        }
        if (!is_null($height)) {
            $dimension->setHeight($height);
        }
        if (!is_null($length)) {
            $dimension->setLength($length);
        }
        if (!is_null($width)) {
            $dimension->setWidth($width);
        }
        return $dimension;
    }
}
